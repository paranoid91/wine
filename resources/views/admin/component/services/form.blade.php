<div class="row">
    <div class="col-sm-4">
        {!! Form::label('lang',trans('admin.select_language')) !!} <i class="required"></i>
        {!! Form::select('lang',get_languages($lang_id,$lang,'App\Service'),$lang,['class'=>'chose-lang chosen-select-deselect','tabindex'=>8]) !!}
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
    <div class="col-sm-8">
        {!! Form::label('is_publish',trans('admin.public')) !!}
        {!! Form::checkbox('is_publish',1,null,['onClick'=>'return ($(".status").val() == 1) ? $(".status").val(0) : $(".status").val(1);']) !!}
        {!! Form::hidden('is_publish',null,['class'=>'status']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        {!! Form::label('title',trans('admin.title')) !!} <i class="required">*</i>
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        {!! Form::label('text',trans('admin.text')) !!} <i class="required">*</i>
        {!! Form::textarea('text',null,['class'=>'form-control tinymce']) !!}
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="slider_image">
            <div>
                @if(Form::getValueAttribute('poster') <> '')
                <img src="{!! Form::getValueAttribute('poster') !!}" width="100%"/>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        {!! Form::text('poster',null,['class'=>'form-control','id'=>'slider_image','data-width'=>trans('admin.image_width_error'),'data-height'=>trans('admin.image_height_error')]) !!}
    </div>
    <div class="col-sm-4">
        <a href="{{asset('filemanager/dialog.php?type=1&descending=false&field_id="slider_image')}}" class="fancybox btn btn-primary" onClick="getFieldValue('slider_image','{{asset('/')}}',100,300,200);" ><i class="fa fa-image"></i> Select Image *</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        {!! Form::submit(trans('admin.submit'),['class'=>'btn btn-success']) !!}
    </div>
</div>
@include('admin.modals.fade.error')