<?php

namespace Modules\Users\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

use Modules\Users\Models\Access\User\User;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $rootUrlNamespace = 'Modules\Users\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @param  Router $router
     * @return void
     */
    public function before(Router $router)
    {
        //
    }

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Register route model bindings
         */

        /*
         * This allows us to use the Route Model Binding with SoftDeletes on
         * On a model by model basis
         */
        $this->bind('deletedUser', function ($value) {
            $user = new User();

            return User::withTrashed()->where($user->getRouteKeyName(), $value)->first();
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->aliasMiddleware('timeout', \Modules\Users\Http\Middleware\SessionTimeout::class);

        /*
        * Access Middleware
        */
        $router->aliasMiddleware('access.routeNeedsRole', \Modules\Users\Http\Middleware\RouteNeedsRole::class);
        $router->aliasMiddleware('access.routeNeedsPermission', \Modules\Users\Http\Middleware\RouteNeedsPermission::class);

        $router->middlewareGroup('admin', [
            'auth',
            'access.routeNeedsPermission:view-backend',
            'timeout',
        ]);

        $router->middlewareGroup('dashboard', [
            'auth',
        ]);

        if (!app()->routesAreCached()) {
            /**
            * Web Routes
            */
            $router->group(['middleware' => 'web', 'namespace' => $this->rootUrlNamespace, 'module' => 'users'], function()
            {
                require __DIR__ . '/../routes/web.php';
            });
            /**
            * Api Routes
            */
            $router->group(['middleware' => 'api', 'namespace' => $this->rootUrlNamespace,'prefix' => 'api', 'module' => 'users'], function()
            {
                require __DIR__ . '/../routes/api.php';
            });
        }
    }
}
