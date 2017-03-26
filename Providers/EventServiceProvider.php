<?php

namespace Modules\Users\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider.
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [];

    /**
     * Class event subscribers.
     *
     * @var array
     */
    protected $subscribe = [
        /*
         * Frontend Subscribers
         */

        /*
         * Auth Subscribers
         */
        \Modules\Users\Events\Handlers\Frontend\Auth\UserEventListener::class,

        /*
         * Backend Subscribers
         */

        /*
         * Access Subscribers
         */
        \Modules\Users\Events\Handlers\Backend\Access\User\UserEventListener::class,
        \Modules\Users\Events\Handlers\Backend\Access\Role\RoleEventListener::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
