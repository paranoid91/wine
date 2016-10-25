@extends('admin.master')


@section('content') {{-- master @yield(content)--}}

        <div class="panel panel-default">
            <div class="panel-heading">{{trans('admin.edit')}}</div>
            <div class="panel-body">
                {!! Form::model($role,['method'=>'PATCH', 'action'=>['Admin\RolesController@update',$role->id]]) !!}
                @include('admin.component.roles.form',['submitButtonText'=>trans('admin.edit')])
                {!! Form::close() !!}
            </div>
        </div>
        @include('errors.list')

@stop