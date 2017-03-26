<?php

namespace Modules\Users\Events\Handlers\Backend\Access\User;

/**
 * Class UserEventListener.
 */
class UserEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'User';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.created") <strong>{user}</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.updated") <strong>{user}</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.deleted") <strong>{user}</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.restored") <strong>{user}</strong>')
            ->withIcon('refresh')
            ->withClass('bg-aqua')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.permanently_deleted") <strong>{user}</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
    }

    /**
     * @param $event
     */
    public function onPasswordChanged($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.changed_password") <strong>{user}</strong>')
            ->withIcon('lock')
            ->withClass('bg-blue')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeactivated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.deactivated") <strong>{user}</strong>')
            ->withIcon('times')
            ->withClass('bg-yellow')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onReactivated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.backend.users.reactivated") <strong>{user}</strong>')
            ->withIcon('check')
            ->withClass('bg-green')
            ->withAssets([
                'user_link' => ['admin.access.user.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \Modules\Users\Events\Backend\Access\User\UserCreated::class,
            'Modules\Users\Events\Handlers\Backend\Access\User\UserEventListener@onCreated'
        );

        $events->listen(
            \Modules\Users\Events\Backend\Access\User\UserUpdated::class,
            'Modules\Users\Events\Handlers\Backend\Access\User\UserEventListener@onUpdated'
        );

        $events->listen(
            \Modules\Users\Events\Backend\Access\User\UserDeleted::class,
            'Modules\Users\Events\Handlers\Backend\Access\User\UserEventListener@onDeleted'
        );

        $events->listen(
            \Modules\Users\Events\Backend\Access\User\UserRestored::class,
            'Modules\Users\Events\Handlers\Backend\Access\User\UserEventListener@onRestored'
        );

        $events->listen(
            \Modules\Users\Events\Backend\Access\User\UserPermanentlyDeleted::class,
            'Modules\Users\Events\Handlers\Backend\Access\User\UserEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \Modules\Users\Events\Backend\Access\User\UserPasswordChanged::class,
            'Modules\Users\Events\Handlers\Backend\Access\User\UserEventListener@onPasswordChanged'
        );

        $events->listen(
            \Modules\Users\Events\Backend\Access\User\UserDeactivated::class,
            'Modules\Users\Events\Handlers\Backend\Access\User\UserEventListener@onDeactivated'
        );

        $events->listen(
            \Modules\Users\Events\Backend\Access\User\UserReactivated::class,
            'Modules\Users\Events\Handlers\Backend\Access\User\UserEventListener@onReactivated'
        );
    }
}
