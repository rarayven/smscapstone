<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function credentials(Request $request)
    {
        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'id';
        $request->merge([$field => $request->input('email')]);
        return [$field=>$request{$this->username()},'password'=>$request->password,'is_active'=> 1];
    }

    public function showLoginForm()
    {
        return view('SMS.Account.SMSAccountLogin');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|max:30',
            'password' => 'required|max:61',
            ]);
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();
        Session::flash('success','You have successfully logged out.');
        return redirect(route('login'));
    }
}
