@extends('admin.master')

@section('content')
    <h3>{{trans('admin.edit_news')}} : {{$product->id}}</h3>
    <hr>
    <!-- AJAX REQUEST MESSAGE PLACE -->
    <div class="message_place"></div>
    {!! Form::model($product,['method'=>'PATCH','action'=>['Admin\ProductController@update',$product],'class'=>'myForm']) !!}
            <!-- TRANSLATE -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <a href="{{action('Admin\ProductController@translate',[$product->id])}}" class="btn btn-default">{{trans('admin.translate')}}</a>
            </div>
        </div>
    </div>

    <!-- END TRANSLATE -->
    @include('admin.component.product.form',[
           'lang_id'=>$product->lang_id,
           'lang'=>$product->lang,
           'selected_cats'=>get_cat($product->categories->toArray(),false),
           'news_image'=>(count(get_poster($product->files,300)) > 0) ? '<img src="'.asset(get_poster($product->files,300)['path']).'" width="100%"/>' : '',
           'news_image_url' => (count(get_poster($product->files,0)) > 0) ? get_poster($product->files,0)['path'] : '',
           'brand_cat'=>$product->categories[1]->id,
           'type_cat'=>$product->categories[2]->id,
           'images' => $product->files()->where('type','image')->get()
           ])

    {!! Form::close() !!}

            <!-- AJAX REQUEST MESSAGE PLACE -->
    <div class="message_place"></div>
    @include('errors.list')
@stop