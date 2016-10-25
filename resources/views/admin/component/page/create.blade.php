@extends('admin.master')

@section('content')
    <h3>{{trans('admin.add_page')}}</h3>
    <hr>
        <!-- AJAX REQUEST MESSAGE PLACE -->
<div class="message_place"></div>

{!! Form::open(['method'=>'POST','action'=>'Admin\PagesController@store']) !!}

@include('admin.component.page.form',[
           'lang_id' => '',
           'lang' => '',
           'slug' => ''
           ])

{!! Form::close() !!}

        <!-- AJAX REQUEST MESSAGE PLACE -->
<div class="message_place"></div>
@include('errors.list')
@stop