@extends('admin.master')
@section('content') {{-- master @yield(content)--}}
<div class="inspection">
    <h3>აქტის შედგენა</h3>
    <hr>
    {!! Form::open(['method'=>'POST','action'=>'Admin\InspectionController@store','files'=>true,'onSubmit'=>'ajaxData(this,true);return false;','id'=>'inspect_form']) !!}
    @include('admin.component.inspection.form',['images'=>[],'category'=>[],'details'=>[],'work'=>[]])
    {!! Form::close() !!}
</div>

@stop