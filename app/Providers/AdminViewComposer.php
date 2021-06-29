<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminViewComposer extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            [
                'admin.index', 
            ],
            'App\Http\ViewComposers\MenuAdminComposer'
        );
    }
}
