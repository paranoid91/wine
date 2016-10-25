@extends('admin.master')

@section('content')
    <h3>{{trans('admin.add_service')}}</h3>
    <hr>
        <!-- AJAX REQUEST MESSAGE PLACE -->
<div class="message_place"></div>

{!! Form::open(['method'=>'POST','action'=>'Admin\ServicesController@store']) !!}

@include('admin.component.services.form',[
             'lang_id'=>'',
             'lang'=>''
             ])

{!! Form::close() !!}

        <!-- AJAX REQUEST MESSAGE PLACE -->
<div class="message_place"></div>
@include('errors.list')
@stop