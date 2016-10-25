@extends('admin.master')
@section('content') {{-- master @yield(content)--}}
<div class="inspection">
    <h3>აქტის რედაქტირება</h3>
    <hr>
    {!! Form::model($inspection,['method'=>'PATCH','action'=>['Admin\InspectionController@update',$inspection->id],'files'=>true]) !!}
    @include('admin.component.inspection.form',[
    'images'=>is_key($inspection->extra,'image'),
    'category'=>$inspection->categories,
    'details'=>is_key($inspection->extra,'details'),
    'work'=>is_key($inspection->extra,'work')
    ])
    {!! Form::close() !!}
</div>
@stop