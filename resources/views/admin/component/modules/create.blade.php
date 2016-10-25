@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

    <h2>{{trans('admin.add_module')}}</h2>

    {!! Form::open(['action'=>'Admin\ModulesController@store','method'=>'post']) !!}
    @include('admin.component.modules.form',['submitButtonText'=>trans('admin.add')])
    {!! Form::close() !!}
    @include('errors.list')
@stop