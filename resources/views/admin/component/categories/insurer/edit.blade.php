@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<h2>{{trans('admin.insurer')}}</h2>

{!! Form::model($cat,['method'=>'PATCH', 'action'=>['Admin\InsurerController@update',$cat->id]]) !!}

@include('admin.component.categories.insurer.form',['submitButtonText'=>trans('admin.save')])

{!! Form::close() !!}

@include('errors.list')

@stop