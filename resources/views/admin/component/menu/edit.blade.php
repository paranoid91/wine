@extends('admin.master')

@section('content')

    <h2>{{trans('admin.edit')}}</h2>

    @include('admin.component.menu.form',['data'=>$item->value,'name'=>$item->name,'lang'=>$item->lang,'route'=>action('Admin\MenuBuilderController@update',$item->id),'method'=>'PUT'])
@stop