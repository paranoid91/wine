@extends('admin.master')


@section('content') {{-- master @yield(content)--}}

<div class="panel panel-default">
    <div class="panel-heading">{{ trans('admin.create_group') }}</div>
    <div class="panel-body">
        {!! Form::open(['action'=>'Admin\RolesController@store']) !!}
        @include('admin.component.roles.form',['submitButtonText'=>trans('admin.create')])
        {!! Form::close() !!}
    </div>
</div>
@include('errors.list')
</div>

@stop