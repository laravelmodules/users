<?php

namespace Modules\Users\Http\Controllers\Backend\Access\User;

use Modules\Users\Models\Access\User\User;
use Modules\Users\Http\Controllers\Controller;
use Modules\Users\Repositories\Backend\Access\User\UserRepository;
use Modules\Users\Http\Requests\Backend\Access\User\ManageUserRequest;

/**
 * Class UserStatusController.
 */
class UserStatusController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeactivated(ManageUserRequest $request)
    {
        return view('views::backend.access.deactivated');
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageUserRequest $request)
    {
        return view('views::backend.access.deleted');
    }

    /**
     * @param User $user
     * @param $status
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function mark(User $user, $status, ManageUserRequest $request)
    {
        $this->users->mark($user, $status);

        return redirect()->route($status == 1 ? 'admin.access.user.index' : 'admin.access.user.deactivated')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

    /**
     * @param User              $deletedUser
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function delete(User $deletedUser, ManageUserRequest $request)
    {
        $this->users->forceDelete($deletedUser);

        return redirect()->route('admin.access.user.deleted')->withFlashSuccess(trans('alerts.backend.users.deleted_permanently'));
    }

    /**
     * @param User              $deletedUser
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function restore(User $deletedUser, ManageUserRequest $request)
    {
        $this->users->restore($deletedUser);

        return redirect()->route('admin.access.user.index')->withFlashSuccess(trans('alerts.backend.users.restored'));
    }
}
