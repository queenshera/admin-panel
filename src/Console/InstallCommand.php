<?php

namespace Queenshera\AdminPanel\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use phpDocumentor\Reflection\Types\Void_;
use RuntimeException;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    protected $signature = 'adminPanel:install';

    protected $description = 'Install admin panel components and resources';

    public function handle()
    {
        // install other packages
        if (!$this->requireComposerPackages('illuminate/support')) {
            return 1;
        }
        if (!$this->requireComposerPackages('illuminate/console')) {
            return 1;
        }
        if (!$this->requireComposerPackages('barryvdh/laravel-debugbar')) {
            return 1;
        }
        if (!$this->requireComposerPackages('barryvdh/laravel-dompdf')) {
            return 1;
        }
        if (!$this->requireComposerPackages('laravel/ui')) {
            return 1;
        }
        if (!$this->requireComposerPackages('livewire/livewire')) {
            return 1;
        }
        $this->installS3();
        $this->installFirebase();
        $this->installPest();

        // copy controller files
        (new Filesystem())->copyDirectory(__DIR__ . '/../Http/Controllers', app_path('Http/Controllers'));

        // copy middleware files
        (new Filesystem())->copyDirectory(__DIR__ . '/../Http/Middleware', app_path('Http/Middleware'));
        copy(__DIR__ . '/../Http/Kernel.php', app_path('Http/Kernel.php'));

        // copy model files
        copy(__DIR__ . '/../../stubs/app/Models/User.php', app_path('Models/User.php'));

        // copy rule files
        (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/app/Rules', app_path('Rules'));

        // copy config files
        (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/config', config_path(''));

        // copy public assets
        (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/public/panel', public_path('vendor/adminPanel'));

        // copy view files
        (new Filesystem())->copyDirectory(__DIR__ . '/../resources/views', resource_path('views'));

        // copy database files
        copy(__DIR__ . '/../database/migrations/2014_10_12_000000_create_users_table.php', database_path('migrations/2014_10_12_000000_create_users_table.php'));

        // copy database files
        copy(__DIR__ . '/../routes/web.php', base_path('routes/web.php'));
        copy(__DIR__ . '/../routes/api.php', base_path('routes/api.php'));

        // link storage
        $this->runCommands(['php artisan storage:link']);

        // copy env file details
        copy(__DIR__ . '/../../.env.example', base_path('.env.example'));
        copy(__DIR__ . '/../../.env.example', base_path('.env'));
        $this->runCommands(['php artisan config:cache', 'php artisan key:generate', 'php artisan config:cache']);
    }

    protected function installS3()
    {
        if (!$this->requireComposerPackages('league/flysystem-aws-s3-v3')) {
            return 1;
        }
    }

    protected function installFirebase()
    {
        if (!$this->requireComposerPackages('kreait/laravel-firebase')) {
            return 1;
        }
    }

    protected function installPest()
    {
        if (!$this->requireComposerDevPackages('pestphp/pest')) {
            return 1;
        }
        if (!$this->requireComposerDevPackages('pestphp/pest-plugin-laravel')) {
            return 1;
        }
        copy(__DIR__ . '/../../stubs/pest-tests/Pest.php', base_path('tests/Pest.php'));
        copy(__DIR__ . '/../../stubs/pest-tests/Feature/ExampleTest.php', base_path('tests/Feature/ExampleTest.php'));
        copy(__DIR__ . '/../../stubs/pest-tests/Unit/ExampleUnitTest.php', base_path('tests/Unit/ExampleTest.php'));
    }

    protected function requireComposerPackages($packages)
    {
        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        return !(new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    protected function removeComposerDevPackages($packages)
    {
        $command = array_merge(
            $command ?? ['composer', 'remove', '--dev'],
            is_array($packages) ? $packages : func_get_args()
        );

        return (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
                ->setTimeout(null)
                ->run(function ($type, $output) {
                    $this->output->write($output);
                }) === 0;
    }

    protected function requireComposerDevPackages($packages)
    {
        $command = array_merge(
            $command ?? ['composer', 'require', '--dev'],
            is_array($packages) ? $packages : func_get_args()
        );

        return (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
                ->setTimeout(null)
                ->run(function ($type, $output) {
                    $this->output->write($output);
                }) === 0;
    }

    protected function runCommands($commands)
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> ' . $e->getMessage() . PHP_EOL);
            }
        }

        $process->run(function ($type, $line) {
            $this->output->write('    ' . $line);
        });
    }
}
