@extends('admin.master')

@section('content')
    <h3>{{trans('admin.add_news')}}</h3>
    <hr>
    <!-- AJAX REQUEST MESSAGE PLACE -->
    <div class="message_place"></div>

    {!! Form::open(['method'=>'POST','action'=>'Admin\NewsController@store','class'=>'myForm']) !!}

    @include('admin.component.news.form',[
               'lang_id' => '',
               'lang' => '',
               'selected_cats' => '',
               'news_image'=>'',
               'news_image_url'=>'',
               'categories'=>null,
               ])

    {!! Form::close() !!}

            <!-- AJAX REQUEST MESSAGE PLACE -->
    <div class="message_place"></div>
    @include('errors.list')
@stop