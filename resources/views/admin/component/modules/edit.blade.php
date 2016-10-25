@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

    <h2>{{trans('admin.edit_module')}}</h2>

    {!! Form::model($module,['action'=>['Admin\ModulesController@update',$module->id],'method'=>'PATCH']) !!}
    @include('admin.component.modules.form',['submitButtonText'=>trans('admin.edit')])
    {!! Form::close() !!}

    @include('errors.list')
@stop