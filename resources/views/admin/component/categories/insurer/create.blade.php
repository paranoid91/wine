@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<h2>{{trans('admin.insurer')}}</h2>

{!! Form::open(['action'=>'Admin\InsurerController@store']) !!}

@include('admin.component.categories.insurer.form',['submitButtonText'=>trans('admin.add')])

{!! Form::close() !!}

@include('errors.list')

@stop