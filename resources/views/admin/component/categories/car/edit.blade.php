@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<h2>{{trans('admin.car_marks_and_models')}}</h2>

{!! Form::model($cat,['method'=>'PATCH', 'action'=>['Admin\CarController@update',$cat->id]]) !!}

@include('admin.component.categories.car.form',['submitButtonText'=>trans('admin.save')])

{!! Form::close() !!}

@include('errors.list')

@stop