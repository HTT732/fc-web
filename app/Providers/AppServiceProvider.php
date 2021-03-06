<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;
use Cookie;
use Str;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Product\ProductRepositoryInterface::class,
            \App\Repositories\Product\ProductRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Picture\PictureRepositoryInterface::class,
            \App\Repositories\Picture\PictureRepository::class
        );

        $this->app->singleton(
            \App\Repositories\ProductOrder\ProductOrderRepositoryInterface::class,
            \App\Repositories\ProductOrder\ProductOrderRepository::class
        );

        $this->app->singleton(
            \App\Repositories\OrderDetail\OrderDetailRepositoryInterface::class,
            \App\Repositories\OrderDetail\OrderDetailRepository::class
        );

        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        if (env('APP_ENV') == 'production') {
            URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS','on');
        }
        
        // set cookie 
        makeCookie('order_token','', request()->gethost());
    }
}
