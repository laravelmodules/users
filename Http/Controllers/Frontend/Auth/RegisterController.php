<?php

namespace Modules\Users\Http\Controllers\Frontend\Auth;

use Modules\Users\Http\Controllers\Controller;
use Modules\Users\Events\Frontend\Auth\UserRegistered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Modules\Users\Http\Requests\Frontend\Auth\RegisterRequest;
use Modules\Users\Repositories\Frontend\Access\User\UserRepository;

/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        // Where to redirect users after registering
        $this->redirectTo = route('frontend.index');

        $this->user = $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('views::frontend.auth.register');
    }

    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterRequest $request)
    {
        // dd($request->all());
        if (config('access.users.confirm_email')) {
            $user = $this->user->create($request->all());
            event(new UserRegistered($user));

            return redirect($this->redirectPath())->withFlashSuccess(trans('exceptions.frontend.auth.confirmation.created_confirm'));
        } else {
            access()->login($this->user->create($request->all()));
            event(new UserRegistered(access()->user()));

            return redirect($this->redirectPath());
        }
    }
}
