<?php

namespace Dnsoft\Acl\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('acl::auth.login');
    }

    protected function redirectTo()
    {
        $config = config('acl.redirect_after_login', config('core.admin_prefix'));
        return is_callable($config) ? $config() : $config;
    }

    protected function loggedOut(Request $request)
    {
        $config = config('acl.redirect_after_logout', route('admin.login'));
        $redirectAfterLogout = is_callable($config) ? $config() : $config;

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect($redirectAfterLogout);
    }
}
