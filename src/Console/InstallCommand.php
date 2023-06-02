<?php

namespace Queenshera\AdminPanel\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use RuntimeException;
use Symfony\Component\Process\Process;
use function Pest\Laravel\json;

class InstallCommand extends Command
{
    protected $signature = 'adminPanel:install';

    protected $description = 'Install admin panel components and resources';

    /**
     * @return int|void
     */
    public function handle()
    {
        $this->info("Do you want to install optional packages? Your code will not work properly if you don't have packages installed.");
        $packages = $this->choice('Select none, single or multiple packages seperated by comma that you want to install', ['All', 'Debugbar', 'DomPDF', 'AWS S3 Storage', 'Pest Tests', 'Firebase', 'None'], 0, null, true);

        if (!in_array('None', $packages)) {
            // Install optional packages
            if (in_array('All', $packages) || in_array('Debugbar', $packages)) {
                if (!$this->requireComposerPackages('barryvdh/laravel-debugbar')) {
                    return 1;
                }
            }

            if (in_array('All', $packages) || in_array('DomPDF', $packages)) {
                if (!$this->requireComposerPackages('barryvdh/laravel-dompdf')) {
                    return 1;
                }
            }

            if (in_array('All', $packages) || in_array('AWS S3 Storage', $packages)) {
                if (!$this->requireComposerPackages('league/flysystem-aws-s3-v3')) {
                    return 1;
                }
            }

            if (in_array('All', $packages) || in_array('Pest Tests', $packages)) {
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

            if (in_array('All', $packages) || in_array('Firebase', $packages)) {
                if (!$this->requireComposerPackages('kreait/laravel-firebase')) {
                    return 1;
                }

                // copy firebase adminsdk file
                (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/app/Firebase', app_path('Http/Firebase'));
            }
        }

        copy(__DIR__ . '/../../stubs/config/adminPanel.php', config_path('adminPanel.php'));
        copy(__DIR__ . '/../../stubs/config/app.php', config_path('app.php'));
        copy(__DIR__ . '/../../stubs/config/filesystems.php', config_path('filesystems.php'));
        copy(__DIR__ . '/../../stubs/config/msg91.php', config_path('msg91.php'));
        copy(__DIR__ . '/../../stubs/config/razorpay.php', config_path('razorpay.php'));
        copy(__DIR__ . '/../../stubs/config/textlocal.php', config_path('textlocal.php'));

        if (in_array('All', $packages) || in_array('Debugbar', $packages)) {
            copy(__DIR__ . '/../../stubs/config/debugbar.php', config_path('debugbar.php'));
        }

        if (in_array('All', $packages) || in_array('DomPDF', $packages)) {
            copy(__DIR__ . '/../../stubs/config/dompdf.php', config_path('dompdf.php'));
        }

        // copy controller files
        (new Filesystem())->copyDirectory(__DIR__ . '/../Http/Controllers', app_path('Http/Controllers'));

        // copy livewire files
        (new Filesystem())->copyDirectory(__DIR__ . '/../Http/Livewire', app_path('Http/Livewire'));

        // copy middleware files
        (new Filesystem())->copyDirectory(__DIR__ . '/../Http/Middleware', app_path('Http/Middleware'));
        copy(__DIR__ . '/../Http/Kernel.php', app_path('Http/Kernel.php'));

        // copy model files
        copy(__DIR__ . '/../../stubs/app/Models/User.php', app_path('Models/User.php'));

        // copy public assets
        (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/public/panel', public_path('vendor/adminPanel'));

        // copy view files
        (new Filesystem())->copyDirectory(__DIR__ . '/../resources/views', resource_path('views'));

        // copy database files
        (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/database/migrations', database_path('migrations'));

        // copy route files
        (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/routes', base_path('routes'));

        if ($this->confirm("Do you want to local storage link?")) {
            // link storage
            $this->runCommands(['php artisan storage:link']);
        }

        // copy env file details
        copy(__DIR__ . '/../../.env.example', base_path('.env.example'));
        $this->runCommands(['php artisan config:cache']);
    }

    /**
     * @param $packages
     * @return bool
     */
    protected function requireComposerPackages($packages)
    {
        $command = array_merge(
            $command ?? ['composer', 'require', '--with-all-dependencies'],
            is_array($packages) ? $packages : func_get_args()
        );

        return !(new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * @param $packages
     * @return bool
     */
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

    /**
     * @param $packages
     * @return bool
     */
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

    /**
     * @param $commands
     * @return void
     */
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
