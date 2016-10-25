<!-- HIDDEN PRODUCTS CAT -->
{!! Form::hidden('cat[0]',2065) !!}
{!! Form::hidden('slug',null) !!}


<div class="row">
    <div class="col-sm-8">
        {!! Form::label('status',trans('admin.public')) !!}
        {!! Form::checkbox('status',2,null,['onClick'=>'return ($(".status").val() == 2) ? $(".status").val(0) : $(".status").val(2);']) !!}
        {!! Form::hidden('status',null,['class'=>'status']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('lang',trans('admin.select_language')) !!} <i class="required"></i>
        {!! Form::select('lang',get_languages($lang_id,$lang,App\Product::select('lang')->where('lang_id',$lang_id)->get()),$lang,['class'=>'chose-lang chosen-select-deselect','tabindex'=>8]) !!}
        <script>
            $(function(){
                $('.chose-lang').chosen({
                    allow_single_deselect: true,
                    scroll_on_hover: false
                });
            });
        </script>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        @if(count($brands) > 0)
        <label for="select-brand">{{ trans("admin.sel-brand") }}</label>
            <i class="required">*</i>

            {!! Form::select('cat[1]',[''=>'---']+idAsKey($brands),$brand_cat,['class'=>'chose-lang chosen-select-deselect','id'=>'select-brand','data-placeholder'=>'Select an option']) !!}
        @else
            <div class="alert alert-warning">
                <strong>No Brands Found</strong>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        @if(count($types) > 0)
            <label for="select-type">{{ trans("admin.sel-type") }}</label>
            <i class="required">*</i>
            {!! Form::select('cat[2]',[''=>'---']+idAsKey($types),$type_cat,['class'=>'chose-lang chosen-select-deselect','id'=>'select-brand','data-placeholder'=>'Select an option']) !!}

        @else
            <div class="alert alert-warning">
                <strong>No Types Found</strong>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        {!! Form::label('title',trans('admin.title')) !!} <i class="required">*</i>
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        {!! Form::label('price',trans('admin.price')) !!} <i class="required">*</i>
        {!! Form::text('price',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        {!! Form::label('extra_texas',trans('admin.ex-texas')) !!}
        {!! Form::text('extra_texas',null,['class'=>'form-control']) !!}
    </div>
</div>

{{--
<div class="row">
    <div class="col-sm-6">
        {!! Form::label('desc',trans('admin.description')) !!}
        {!! Form::textarea('desc',null,['class'=>'form-control','style'=>'height:80px']) !!}
    </div>
</div>
--}}

<div class="row">
    <div class="col-sm-7">
        {!! Form::label('description',trans('admin.description')) !!} <i class="required">*</i>
        {!! Form::textarea('description',null,['class'=>'form-control tinymce']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        {!! Form::label('delivery',trans('admin.delivery')) !!}
        {!! Form::textarea('delivery',null,['class'=>'form-control tinymce']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        {!! Form::label('serving_tips',trans('admin.serving')) !!}
        {!! Form::textarea('serving_tips',null,['class'=>'form-control tinymce']) !!}
    </div>
</div>
<div class="row">

    <div class="col-sm-6 images myItemImages">
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="ni_0">
                        <div>
                            {!! $news_image !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::text('image[0]',$news_image_url,['class'=>'form-control','id'=>'ni_0']) !!}
                </div>
                <div class="col-sm-6">
                    <a href="{{asset('filemanager/dialog.php?type=1&descending=false&field_id=ni_0')}}" class="fancybox btn btn-primary" onClick="getFieldValue('ni_0','{{asset('/')}}',100);" ><i class="fa fa-image"></i> Select Image *</a>
                </div>

            </div>
        </div>
        @if(isset($images))
            @foreach($images as $key=>$img)
                @if($key > 0)
                    <div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ni_{{$key}}">
                                    <div>
                                        <img src="{{get_image($img,300)}}" width="100%"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                {!! Form::text('image['.$key.']',get_image($img),['class'=>'form-control','id'=>'ni_'.$key]) !!}
                            </div>
                            <div class="col-sm-6">
                                <a href="{{asset('filemanager/dialog.php?type=1&descending=false&field_id=ni_'.$key.'')}}" class="fancybox btn btn-primary" onClick="getFieldValue('ni_{{$key}}','{{asset('/')}}',100);" ><i class="fa fa-image"></i> Select Image *</a>
                            </div>

                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        {!! Form::button('<i class="fa fa-plus"></i> მეტი',['class'=>'btn btn-primary','id'=>'add_more']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::button('<i class="fa fa-minus"></i> ბოლოს წაშლა',['class'=>'btn btn-danger','id'=>'del_image']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::submit(trans('admin.submit'),['class'=>'btn btn-success']) !!}
    </div>
</div>
<script>
    $(function(){
        var html = '<div><div class="row"><div class="col-sm-12"> <div class="ni_"><div></div></div></div></div><div class="row">' +
                   '<div class="col-sm-6">'+
                   '{!! Form::text('image[]',null,['class'=>'form-control','id'=>'ni_']) !!}</div>'+
                   '<div class="col-sm-6">'+
                   '<a href="{{asset('filemanager/dialog.php?type=1&descending=false&field_id=ni_')}}" class="fancybox btn btn-primary" onClick="getFieldValue(\'ni_\',\'{{asset('/')}}\',100);" ><i class="fa fa-image"></i> Select Image *</a></div></div></div>';
        $('#add_more').Fields(html,{appendClass:'images',del:'del_image',chosen_prefix:'ni_'});
    });
</script>
