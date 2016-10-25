@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<h2>{{trans('admin.section_category_add')}}</h2>

{!! Form::open(['action'=>'Admin\NewsCatController@store']) !!}

@include('admin.component.categories.newsCat.form',['submitButtonText'=>trans('admin.add')])

{!! Form::close() !!}

@include('errors.list')

@stop