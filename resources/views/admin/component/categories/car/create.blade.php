@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<h2>{{trans('admin.car_marks_and_models')}}</h2>

{!! Form::open(['action'=>'Admin\CarController@store']) !!}

@include('admin.component.categories.car.form',['submitButtonText'=>trans('admin.add')])

{!! Form::close() !!}

@include('errors.list')

@stop