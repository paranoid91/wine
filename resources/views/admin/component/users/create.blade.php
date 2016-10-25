@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<h2>{{trans('admin.add_account')}}</h2>

{!! Form::open(['action'=>'Admin\UsersController@store']) !!}

@include('admin.component.users.form',['submitButtonText'=>trans('admin.add'),'selected_role'=>null])

{!! Form::close() !!}

@include('errors.list')

@stop