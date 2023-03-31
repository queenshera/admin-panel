<?php

namespace Queenshera\AdminPanel;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Queenshera\AdminPanel\Console\InstallCommand;

class QsAdminPanelServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->commands([
            InstallCommand::class
        ]);

    }

}
