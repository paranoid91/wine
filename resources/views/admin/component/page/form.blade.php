<!-- HIDDEN PRODUCTS CAT -->
{!! Form::hidden('cat',1) !!}
{!! Form::hidden('slug',$slug) !!}

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('lang',trans('admin.select_language')) !!} <i class="required"></i>
        {!! Form::select('lang',get_languages($lang_id,$lang),$lang,['class'=>'chose-lang chosen-select-deselect','tabindex'=>8]) !!}
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
        {!! Form::label('title',trans('admin.title')) !!}
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        {!! Form::label('text',trans('admin.text')) !!}
        {!! Form::textarea('text',null,['class'=>'form-control tinymce']) !!}
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        {!! Form::submit(trans('admin.submit'),['class'=>'btn btn-success']) !!}
    </div>
</div>
