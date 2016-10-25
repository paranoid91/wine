@extends('admin.master')
@section('content') {{-- master @yield(content)--}}
     <div class="auth">
         <div class="row">
             <div class="col-sm-12">
                 <h1>{{trans('admin.admin_panel')}}</h1>
             </div>
         </div>
         <div class="row">
             <div class="col-sm-2"></div>
             <div class="col-sm-10">
                @include('errors.auth')
             </div>
         </div>
         {!! Form::open(['action'=>'Admin\Auth\AuthController@postLogin']) !!}
         <div class="row">
             <div class="col-sm-2">
                 <span class="focus"><img src="{{asset('admin/images/auth/focus.png')}}"/></span>
                 <i class="login-icon"></i>
             </div>
             <div class="col-sm-10">
                 {!! Form::email('email',null,['placeholder'=>trans('admin.email'),'class'=>'auth-email']) !!}
             </div>
         </div>
         <div class="row">
             <div class="col-sm-2">
                 <span class="focus"><img src="{{asset('admin/images/auth/focus.png')}}"/></span>
                 <i class="pwd-icon"></i>
             </div>
             <div class="col-sm-10">
                 {!! Form::password('password',['placeholder'=>trans('admin.password'),'class'=>'auth-pwd']) !!}
             </div>
         </div>
         <div class="row">
             <div class="col-sm-13">
                 {!! Form::submit(trans('admin.login',['class'=>'auth-login'])) !!}
             </div>
         </div>
         <div class="row">
             <div class="col-sm-13 remember">
                 {!! Form::checkbox('remember',1,null,['id'=>'remember']) !!}
                 {!! Form::label('remember',trans('admin.remember_me')) !!}
             </div>
         </div>
         {!! Form::close() !!}
     </div>
@stop