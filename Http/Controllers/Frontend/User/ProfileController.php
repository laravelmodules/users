<?php

namespace Modules\Users\Http\Controllers\Frontend\User;

use Modules\Users\Http\Controllers\Controller;
use Modules\Users\Http\Requests\Frontend\User\UpdateProfileRequest;
use Modules\Users\Repositories\Frontend\Access\User\UserRepository;

/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return mixed
     */
    public function update(UpdateProfileRequest $request)
    {
        $output = $this->user->updateProfile(access()->id(), $request->all());

        // E-mail address was updated, user has to reconfirm
        if (is_array($output) && $output['email_changed']) {
            access()->logout();

            return redirect()->route('frontend.auth.login')->withFlashInfo(trans('strings.frontend.user.email_changed_notice'));
        }

        return redirect()->route('frontend.user.account')->withFlashSuccess(trans('strings.frontend.user.profile_updated'));
    }
}
