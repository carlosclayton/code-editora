<?php

namespace CodeEduUser\Providers;

use CodeEditora\Providers\AppServiceProvider;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\FilesystemCache;
use Illuminate\Support\ServiceProvider;
use Doctrine\Common\Annotations\Reader;
use CodeEduUser\Annotations\PermissionReader;
use CodeEduUser\Http\Controllers\UsersController;
use CodeEduUser\Annotations\Mapping\ControllerAnnotation;
use Jrean\UserVerification\UserVerificationServiceProvider;


class CodeEduUserServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->publishMigrationsAndSeerders();

        /*
        $reader = app(Reader::class);
        dd($reader->getClassAnnotations(new \ReflectionClass(UsersController::class), ControllerAnnotation::class));
        */
        $reader = app(PermissionReader::class);
        $reader->getPermissions();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(UserVerificationServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AppServiceProvider::class);
        $this->registerAnnotations();
        $this->app->bind(Reader::class, function(){
            return new CachedReader(
                new AnnotationReader(),
                new FilesystemCache(storage_path('framework/cache/doctrine-annotations')),
                $debug = env('APP_DEBUG')
            );
        });

    }


    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('codeeduuser.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'codeeduuser'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/codeeduuser');

        $sourcePath = __DIR__.'/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/codeeduuser';
        }, \Config::get('view.paths')), [$sourcePath]), 'codeeduuser');
    }


    public function publishMigrationsAndSeerders()
    {
        $sourcePath = __DIR__ . "/../database/migrations";
        $this->publishes([
            $sourcePath => database_path('migrations')
        ], 'migrations');

        $sourcePath = __DIR__ . "/../database/seeders";
        $this->publishes([
            $sourcePath => database_path('seeds')
        ], 'seeders');

    }


    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/codeeduuser');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'codeeduuser');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../resources/lang', 'codeeduuser');
        }
    }

    public function registerAnnotations(){
        $loader = require __DIR__ . "/../../../vendor/autoload.php";
        AnnotationRegistry::registerLoader([$loader, 'loadClass']);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}