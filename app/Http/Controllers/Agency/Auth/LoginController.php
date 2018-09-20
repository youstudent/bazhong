<?php

namespace App\Http\Controllers\Agency\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/agency/index/index';


    /**
     * 登陆视图重写
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('agency.auth.login');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //是用指定的中间件  默认是使用 guest:web中间件
        $this->middleware('guest:business')->except('logout');
    }

    /**
     * 登陆账号使用字段名
     * @return string
     */
    public function username()
    {
        return 'phone';
    }


    /**
     * 验证使用中间件名字
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return \Auth::guard('business');
    }


    /**
     * 退出
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        //清除session指定中间件
        $request->session()->forget($this->guard()->getName());

        $request->session()->regenerate();

        return $this->loggedOut($request) ?: redirect('/agency/login');
    }
}
