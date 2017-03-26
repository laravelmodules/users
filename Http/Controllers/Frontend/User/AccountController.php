<?php

namespace Modules\Users\Http\Controllers\Frontend\User;

use Modules\Users\Http\Controllers\Controller;

/**
 * Class AccountController.
 */
class AccountController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('views::dashboard.user.account');
    }
}
