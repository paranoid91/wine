<div class="row"  style="margin-bottom:15px;">
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('parent',trans('admin.car_marks_and_models')) !!}
            {!! Form::select('parent',['---']+idAsKey($categories,'name'),null,['class'=>'mark chosen-select']) !!}
            <script>
                $('.mark').chosen({
                    allow_single_deselect: true,
                    scroll_on_hover: false
                })
            </script>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('name',trans('admin.car_model_or_mark')) !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::submit($submitButtonText,['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>