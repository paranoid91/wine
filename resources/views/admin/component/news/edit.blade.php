@extends('admin.master')

@section('content')
    <h3>{{trans('admin.edit_news')}} : {{$news->id}}</h3>
    <hr>
    <!-- AJAX REQUEST MESSAGE PLACE -->
    <div class="message_place"></div>
    {!! Form::model($news,['method'=>'PATCH','action'=>['Admin\NewsController@update',$news],'class'=>'myForm']) !!}
            <!-- TRANSLATE -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <a href="{{action('Admin\NewsController@translate',[$news->id])}}" class="btn btn-default">{{trans('admin.translate')}}</a>
            </div>
        </div>
    </div>
    <!-- END TRANSLATE -->
    @include('admin.component.news.form',[
               'lang_id'=>$news->lang_id,
               'lang'=>$news->lang,
               'selected_cats'=>get_cat($news->categories->toArray(),false),
               'news_image'=>(count(get_poster($news->files,300)) > 0) ? '<img src="'.asset(get_poster($news->files,300)['path']).'" width="100%"/>' : '',
               'news_image_url' => (count(get_poster($news->files,0)) > 0) ? get_poster($news->files,0)['path'] : '',
               'images' => $news->files()->where('type','image')->get(),
               'categories'=>$news->categories[1]->id,
           ])

    {!! Form::close() !!}

            <!-- AJAX REQUEST MESSAGE PLACE -->
    <div class="message_place"></div>
    @include('errors.list')
@stop