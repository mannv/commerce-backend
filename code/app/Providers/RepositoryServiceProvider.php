<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\App\Repositories\CategoryRepository::class, \App\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ColorRepository::class, \App\Repositories\ColorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProductRepository::class, \App\Repositories\ProductRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SizeRepository::class, \App\Repositories\SizeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProductGroupRepository::class, \App\Repositories\ProductGroupRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProductGroupSizeRepository::class, \App\Repositories\ProductGroupSizeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProductGroupImageRepository::class, \App\Repositories\ProductGroupImageRepositoryEloquent::class);
        //:end-bindings:
    }
}
