<?php

namespace Modules\Users\Providers;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
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

        $this->app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \Modules\Users\Exceptions\Handler::class
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(AccessServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(ComposerServiceProvider::class);

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(SidebarServiceProvider::class);
        $this->app->register(BreadcrumbsServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('module/users/users.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'module.users.users'
        );
        /**
        * Access
        */
        $this->publishes([
            __DIR__.'/../Config/access.php' => config_path('access.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/access.php', 'access'
        );
        /**
         * Session
         */
        $this->publishes([
            __DIR__.'/../Config/session.php' => config_path('session.php'),
        ], 'session');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/session.php', 'session'
        );
        /**
         * Services
         */
        $this->publishes([
            __DIR__.'/../Config/services.php' => config_path('services.php'),
        ], 'session');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/services.php', 'services'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/users');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/users';
        }, \Config::get('view.paths')), [$sourcePath]), 'users');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/users');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'users');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'users');
        }
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
