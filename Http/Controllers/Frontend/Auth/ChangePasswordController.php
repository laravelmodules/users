<?php

namespace Modules\Users\Http\Controllers\Frontend\Auth;

use Modules\Users\Http\Controllers\Controller;
use Modules\Users\Repositories\Frontend\Access\User\UserRepository;
use Modules\Users\Http\Requests\Frontend\User\ChangePasswordRequest;

/**
 * Class ChangePasswordController.
 */
class ChangePasswordController extends Controller
{
    /**
   * @var UserRepository
   */
  protected $user;

  /**
   * ChangePasswordController constructor.
   *
   * @param UserRepository $user
   */
  public function __construct(UserRepository $user)
  {
      $this->user = $user;
  }

  /**
   * @param ChangePasswordRequest $request
   *
   * @return mixed
   */
  public function changePassword(ChangePasswordRequest $request)
  {
      $this->user->changePassword($request->all());

      return redirect()->route('frontend.user.account')->withFlashSuccess(trans('strings.frontend.user.password_updated'));
  }
}
