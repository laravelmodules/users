<?php

namespace Modules\Users\Http\Controllers\Backend\Access\User;

use Modules\Users\Models\Access\User\User;
use Modules\Users\Http\Controllers\Controller;
use Modules\Users\Notifications\Frontend\Auth\UserNeedsConfirmation;
use Modules\Users\Http\Requests\Backend\Access\User\ManageUserRequest;

/**
 * Class UserConfirmationController.
 */
class UserConfirmationController extends Controller
{
    /**
     * @param User              $user
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function sendConfirmationEmail(User $user, ManageUserRequest $request)
    {
        $user->notify(new UserNeedsConfirmation($user->confirmation_code));

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.confirmation_email'));
    }
}
