@extends('admin.master')

@section('content')
    <h2>{{ trans('admin.create') }}</h2>

    @include('admin.component.menu.form',['data'=>'','name'=>'','route'=>action('Admin\MenuBuilderController@store'),
    'method'=>'POST','item'=>[],'lang' => 'ka',
    ])

    @stop