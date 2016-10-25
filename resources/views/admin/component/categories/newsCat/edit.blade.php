@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<h2>{{trans('admin.section_category_edit')}}</h2>

{!! Form::model($cat,['method'=>'PATCH', 'action'=>['Admin\NewsCatController@update',$cat->id]]) !!}

@include('admin.component.categories.newsCat.form',['submitButtonText'=>trans('admin.save')])

{!! Form::close() !!}

@include('errors.list')

@stop