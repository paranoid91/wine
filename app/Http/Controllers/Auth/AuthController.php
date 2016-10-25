<?php

namespace App\Http\Controllers\Auth;

use App\Jobs\SendMail;
use App\Jobs\PwdEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
            'name' => 'required|between:2,50|alpha',
            'last_name' => 'required|between:2,50|alpha',
            'email' => 'required|email|unique:customers',
            'telephone' => 'required|integer|unique:customers|digits_between:8,15',
            'password' => 'required|between:8,255|confirmed',
            'address' => 'required|max:255',
            'city' => 'required|string|max:50',
            'post_code' => 'required|integer|digits_between:4,8',
            'region' => 'required|string|max:60',
            'confirm_policy' => 'required',
            'g-recaptcha-response' => 'required|captcha'
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
        return User::create($data);
    }


    /**
     * @param Request $request
     * @return string
     */
    public function newLogin(Request $request){
        $validator =  Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $this->incrementLoginAttempts($request);

        $credentials = $this->getCredentials($request);
        if(Auth::validate($credentials)){
            $user = Auth::getLastAttempted();

            if($user->verify){
                $userLogin = Auth::attempt($request->only('email','password'));
                if($userLogin){
                    return 'success';
                }else{
                    $validator->after(function($validator)
                    {
                        $validator->errors()->add('error_data', trans('front.cant_connect_data'));
                    });
                }
            }else{
                $validator->after(function($validator)
                {
                    $validator->errors()->add('not_verified', trans('front.not_verified_check_email_or_spam'));
                });
            }
        }else{
            $user = User::where('email',$request->input('email'))->whereBetween('updated_at',[Carbon::createFromDate(2000,3,20,'Asia/Tbilisi'),Carbon::createFromDate(2016,3,20,'Asia/Tbilisi')])->first();
            if(count($user)>0){
                $user->update(['confirmation_code'=>str_random(32)]);
                $this->dispatch(new PwdEmail($user));
                $validator->after(function($validator)
                {
                    $validator->errors()->add('password_expired', trans('front.password_expired_check_your_email'));
                });
            }else{
                $validator->after(function($validator)
                {
                    $validator->errors()->add('email_password', trans('front.wrong_email_or_password'));
                });
            }
        }


        if($validator->fails()){
            return $validator->getMessageBag()->toJson();
        }
        //return $this->login($request);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function newRegister(Request $request){
        $validator =  $this->validator($request->all());
        if($validator->fails()){
            return $validator->getMessageBag()->toJson();
        }else{
            $request->request->add(['confirmation_code'=>str_random(30)]);
            $user = $this->create($request->all());
            $user->addRole(5);
            $this->dispatch(new SendMail($user));
            return "success";
        }

        //return $this->login($request);
    }

    public function confirm($confirm){
        $user = User::where('confirmation_code',$confirm);
        $user->update(['verify'=>1]);
        return redirect(action('Frontend\HomeController@index',['verify'=>'verify_success']));
    }
}
