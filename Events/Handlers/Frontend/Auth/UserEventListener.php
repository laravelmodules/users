<?php

namespace Modules\Users\Events\Handlers\Frontend\Auth;

use Carbon\Carbon;

/**
 * Class UserEventListener.
 */
class UserEventListener
{
    /**
     * @param $event
     */
    public function onLoggedIn($event)
    {
        $event->user->logins = $event->user->logins+1;
        $event->user->last_login = Carbon::now();
        $event->user->update();

        \Log::info('User Logged In: '.$event->user->name);
    }

    /**
     * @param $event
     */
    public function onLoggedOut($event)
    {
        \Log::info('User Logged Out: '.$event->user->name);
    }

    /**
     * @param $event
     */
    public function onRegistered($event)
    {
        \Log::info('User Registered: '.$event->user->name);
    }

    /**
     * @param $event
     */
    public function onConfirmed($event)
    {
        \Log::info('User Confirmed: '.$event->user->name);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \Modules\Users\Events\Frontend\Auth\UserLoggedIn::class,
            'Modules\Users\Events\Handlers\Frontend\Auth\UserEventListener@onLoggedIn'
        );

        $events->listen(
            \Modules\Users\Events\Frontend\Auth\UserLoggedOut::class,
            'Modules\Users\Events\Handlers\Frontend\Auth\UserEventListener@onLoggedOut'
        );

        $events->listen(
            \Modules\Users\Events\Frontend\Auth\UserRegistered::class,
            'Modules\Users\Events\Handlers\Frontend\Auth\UserEventListener@onRegistered'
        );

        $events->listen(
            \Modules\Users\Events\Frontend\Auth\UserConfirmed::class,
            'Modules\Users\Events\Handlers\Frontend\Auth\UserEventListener@onConfirmed'
        );
    }
}
