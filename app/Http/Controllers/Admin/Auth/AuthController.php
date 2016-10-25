<?php

namespace App\Http\Controllers\Admin\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;



class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * @var custom variables
     */
    protected $auth,$registrar;
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    //protected $redirectTo = 'admin/inspection';
    protected $redirectTo = 'admin/home';

    /**
     * @var int login attempt number
     */
    protected $maxLoginAttempts = 5; // Amount of bad attempts user can make

    /**
     * @var int lockout time after faild logins
     */
    protected $lockoutTime = 300;


    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auth(){
        return view('admin.component.auth.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        return $this->login($request);
    }



}
