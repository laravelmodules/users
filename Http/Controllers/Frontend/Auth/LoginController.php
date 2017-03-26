<?php

namespace Modules\Users\Http\Controllers\Frontend\Auth;

use Modules\Users\Helpers\Auth\Auth;
use Illuminate\Http\Request;
use Modules\Base\Exceptions\GeneralException;
use Modules\Users\Http\Controllers\Controller;
use Modules\Users\Helpers\Frontend\Auth\Socialite;
use Modules\Users\Events\Frontend\Auth\UserLoggedIn;
use Modules\Users\Events\Frontend\Auth\UserLoggedOut;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * Class LoginController.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    protected function credentials(Request $request)
    {
        $field = filter_var($request->input($this->username()), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$field => $request->input($this->username())]);
        return $request->only($field, 'password');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'login';
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (access()->allow('view-backend')) {
            return route('admin.dashboard');
        }

        return route('frontend.user.dashboard');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('views::frontend.auth.login')
            ->withSocialiteLinks((new Socialite())->getSocialLinks());
    }

    /**
     * @param Request $request
     * @param $user
     *
     * @throws GeneralException
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        /*
         * Check to see if the users account is confirmed and active
         */
        if (! $user->isConfirmed()) {
            access()->logout();
            throw new GeneralException(trans('exceptions.frontend.auth.confirmation.resend', ['user_id' => $user->id]));
        } elseif (! $user->isActive()) {
            access()->logout();
            throw new GeneralException(trans('exceptions.frontend.auth.deactivated'));
        }

        event(new UserLoggedIn($user));

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        /*
         * Boilerplate needed logic
         */

        /*
         * Remove the socialite session variable if exists
         */
        if (app('session')->has(config('access.socialite_session_name'))) {
            app('session')->forget(config('access.socialite_session_name'));
        }

        /*
         * Remove any session data from backend
         */
        app()->make(Auth::class)->flushTempSession();

        /*
         * Fire event, Log out user, Redirect
         */
        event(new UserLoggedOut($this->guard()->user()));

        /*
         * Laravel specific logic
         */
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAs()
    {
        //If for some reason route is getting hit without someone already logged in
        if (! access()->user()) {
            return redirect()->route('frontend.auth.login');
        }

        //If admin id is set, relogin
        if (session()->has('admin_user_id') && session()->has('temp_user_id')) {
            //Save admin id
            $admin_id = session()->get('admin_user_id');

            app()->make(Auth::class)->flushTempSession();

            //Re-login admin
            access()->loginUsingId((int) $admin_id);

            //Redirect to backend user page
            return redirect()->route('admin.access.user.index');
        } else {
            app()->make(Auth::class)->flushTempSession();

            //Otherwise logout and redirect to login
            access()->logout();

            return redirect()->route('frontend.auth.login');
        }
    }
}
