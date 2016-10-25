<?php

namespace App\Http\Controllers;

use App\Jobs\PwdEmail;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class PasswordController extends Controller
{
    use AuthenticatesAndRegistersUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($code)
    {
        $email = User::where('confirmation_code',$code)->firstOrFail()->email;
        return view('frontend.component.expired.index',compact('email','code'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function recover(Request $request){
        $validator = $this->validator($request->all());
        if($validator->fails()){
            if($request->ajax())
            {
                return $validator->getMessageBag()->toJson();
            } else{
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }
        $user = User::where('email',$request->input('email'))->where('confirmation_code',$request->input('confirmation_code'))->first();
        if(isset($user) && $user->update(['confirmation_code'=>'','password'=>$request->input('password')])){
            $userLogin = Auth::attempt($request->only('email','password'));
            if($userLogin){
                return redirect(action('Frontend\HomeController@index'));
            }else{
                $validator->after(function($validator)
                {
                    $validator->errors()->add('wrong', trans('front.something_went_wrong_try_again_later'));
                });
            }
        }else{
            $validator->after(function($validator)
            {
                $validator->errors()->add('wrong', trans('front.something_went_wrong_try_again_later'));
            });
        }
    }


    /**
     * @param $data
     * @return mixed
     */
    public function validator($data){
        return Validator::make($data, [
            'confirmation_code'=>'required|min:16',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgot()
    {
        return view('frontend.component.expired.forgot');
    }

    public function sendemail(Request $request){
        $user = User::where('email',$request->input('email'))->first();
        $user->update(['confirmation_code'=>str_random(32)]);
        $this->dispatch(new PwdEmail($user));
        flash()->success(trans('front.password_recovery_letter_has_been_sent_to_your_email'));
        return redirect(action('PasswordController@forgot'));
    }
}
