@extends("Front.app")

@section("title")
<title>Login</title>
@stop

@section("content")
    <div class="login-wrapper">
        <div class="container container-login">
            <div class="col-sm-6 col-md-6 col-lg-6">
                <h3>NEW CUSTOMER</h3>
                <h4>Register Account</h4>
                <p>By creating an account you will be able to shop faster, be up to date on an order' status, and keep track of the orders you have previously made.</p>
                <br>
                <div>
                    <a class="continue-link" href="{{ action('Frontend\CustomerController@regForm') }}">CONTINUE</a>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 log-form-left">
                <h3>RETURNING CUSTOMER</h3>
                <h4>I am a returning customer</h4>
                {!! Form::open(['method'=>'POST','action'=>'Frontend\CustomerController@signUp','class'=>'login-form']) !!}
                <div class="reg-from-inputs">
                    <div class="form-group">
                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                    </div>
                    <div class="forgot-password-link">
                        <a href="#">Forgot Password?</a><br><br>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('LOGIN', ['class' => 'btn login-submit']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop