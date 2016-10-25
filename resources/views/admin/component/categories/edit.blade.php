@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<h2>{{trans('admin.section_category_edit')}}</h2>

{!! Form::model($cat,['method'=>'PATCH', 'action'=>['Admin\CatController@update',$cat->id]]) !!}

@include('admin.component.categories.form',['submitButtonText'=>trans('admin.save')])

{!! Form::close() !!}

@include('errors.list')

@stop