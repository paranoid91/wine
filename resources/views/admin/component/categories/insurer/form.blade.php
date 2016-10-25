{!! Form::hidden('parent',2062) !!}

<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('name',trans('admin.insurer_name')) !!}
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