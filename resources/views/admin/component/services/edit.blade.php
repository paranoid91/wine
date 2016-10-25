@extends('admin.master')

@section('content')
    <h3>{{trans('admin.edit_service')}} : {{$service->id}}</h3>
    <hr>
    <!-- AJAX REQUEST MESSAGE PLACE -->
    <div class="message_place"></div>
    {!! Form::model($service,['method'=>'PATCH','action'=>['Admin\ServicesController@update',$service]]) !!}
            <!-- TRANSLATE -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <a href="{{action('Admin\ServicesController@translate',[$service->id])}}" class="btn btn-default">{{trans('admin.translate')}}</a>
            </div>
        </div>
    </div>
    @include('admin.component.services.form',[
               'lang_id'=>$service->lang_id,
               'lang'=>$service->lang
               ])
    {!! Form::close() !!}
            <!-- AJAX REQUEST MESSAGE PLACE -->
    <div class="message_place"></div>
    @include('errors.list')
@stop