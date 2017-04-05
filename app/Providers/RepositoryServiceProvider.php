<?php

namespace CodeEditora\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\CodeEditora\Repositories\BookRepository::class, \CodeEditora\Repositories\BookRepositoryEloquent::class);
        $this->app->bind(\CodeEditora\Repositories\CategoryRepository::class, \CodeEditora\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\CodeEditora\Repositories\UserRepository::class, \CodeEditora\Repositories\UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
