@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<h2>{{trans('admin.edit_account')}}</h2>

{!! Form::model($user,['method'=>'PATCH', 'action'=>['Admin\UsersController@update',$user->id]]) !!}

@include('admin.component.users.form',['submitButtonText'=>trans('admin.save'),'selected_role'=>$user->roles[0]->id])

{!! Form::close() !!}

@include('errors.list')

@stop