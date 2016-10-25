@extends('admin.master')

@section('content')
    <h3>{{trans('admin.add_product')}}</h3>
    <hr>
    <!-- AJAX REQUEST MESSAGE PLACE -->
    <div class="message_place"></div>
    @include('errors.list')

    {!! Form::open(['method'=>'POST','action'=>'Admin\ProductController@store','class'=>'myForm']) !!}

    @include('admin.component.product.form',[
               'lang_id' => '',
               'lang' => '',
               'selected_cats' => '',
               'news_image'=>'',
               'news_image_url'=>'',
               'brand_cat'=>null,
               'type_cat'=>null
               ])

    {!! Form::close() !!}
    <!-- AJAX REQUEST MESSAGE PLACE -->
    <div class="message_place"></div>
@stop
