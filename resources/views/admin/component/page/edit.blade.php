@extends('admin.master')

@section('content')
    <h3>{{trans('admin.edit_page')}} : {{$page->id}}</h3>

    <hr>
    <!-- AJAX REQUEST MESSAGE PLACE -->
    <div class="message_place"></div>
    {!! Form::model($page,['method'=>'PATCH','action'=>['Admin\PagesController@update',$page]]) !!}

            <!-- TRANSLATE -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <a href="{{action('Admin\PagesController@translate',[$page->id])}}" class="btn btn-default">{{trans('admin.translate')}}</a>
            </div>
        </div>
    </div>
    <!-- END TRANSLATE -->
    @include('admin.component.page.form',[
           'lang_id'=>$page->lang_id,
           'lang'=>$page->lang,
           'slug'=>$page->slug
           ])

    {!! Form::close() !!}

            <!-- AJAX REQUEST MESSAGE PLACE -->
    <div class="message_place"></div>
    @include('errors.list')
@stop