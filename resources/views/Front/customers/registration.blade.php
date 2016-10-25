@extends("Front.app")

@section("title")
<title>Sign Up</title>
@stop

@section("content")
<div class="reg-wrapper">
    <div class="container reg-main-wrapper">
        @include('errors/list')
        <div class="row no-margin">
            {!! Form::open(['method'=>'POST','action'=>'Auth\AuthController@newRegister','class'=>'sign-up-form']) !!}
                <h3>REGISTRATION</h3>
                <p>If you already have an account with us, please login at the <a class="greenlink" href="{{ action('Frontend\CustomerController@loginForm') }}">Login page</a></p>
                <div class="col-sm-6 col-md-6 col-lg-6 form-side-left no-padding">
                    <h5>Your Personal Details</h5>
                    <div class="reg-from-inputs">
                        <div class="form-group">
                            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => '*First Name']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => '*Last Name']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => '*Email']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => '*Telephone']) !!}
                        </div>
                        <h5>Your Password</h5>
                        <div class="form-group">
                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '*Password']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => '*Password Confirm']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 form-side-right">
                    <h5>Your Address</h5>
                    <div class="reg-from-inputs">
                        <div class="form-group">
                            {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => '*Address 1']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => '*City']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('post_code', null, ['class' => 'form-control', 'placeholder' => '*Post Code']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('region', null, ['class' => 'form-control', 'placeholder' => '*Region']) !!}
                        </div>
                        <h5>Newsletter</h5>
                        <div class="checkbox subsc-input">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <span>Subscribe:</span>&nbsp;&nbsp;&nbsp;{!! Form::checkbox('subscribe', null, true) !!}
                                    </label>
                                </div>
                            </div>
                        </div>
                        {!! app('captcha')->display() !!}
                    </div>
                </div>
                <div class="clear submit-reg">
                    <p class="text-center">
                        I have read and agree to the <a class="greenlink" href="#">Privacy Policy. </a>
                        {!! Form::checkbox('confirm_policy', 'null') !!} &nbsp;&nbsp;
                        {!! Form::submit('Register', ['class' => 'btn reg-submit']) !!}
                    </p>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop