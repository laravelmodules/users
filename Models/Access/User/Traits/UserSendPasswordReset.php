<?php

namespace Modules\Users\Models\Access\User\Traits;

use Modules\Users\Notifications\Frontend\Auth\UserNeedsPasswordReset;

/**
 * Class UserSendPasswordReset.
 */
trait UserSendPasswordReset
{
    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserNeedsPasswordReset($token));
    }
}
