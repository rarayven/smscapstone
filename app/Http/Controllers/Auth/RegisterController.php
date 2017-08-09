<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SmartCounter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:25',
            'middle_name' => 'string|max:25',
            'last_name' => 'required|string|max:25',
            'cell_no' => 'required|string|max:15',
            'email' => 'required|string|email|max:30|unique:users',
            'password' => 'required|string|min:6|confirmed',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $sc = new SmartCounter;
        $user = new User;
        $user->id = $sc->increment('Admin');
        $user->first_name = $data['first_name'];
        $user->middle_name = $data['middle_name'];
        $user->last_name = $data['last_name'];
        $user->cell_no = $data['cell_no'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->is_active = 1;
        $user->save();
        return $user;
    }
}
