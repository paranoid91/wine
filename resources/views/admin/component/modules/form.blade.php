<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('name',trans('admin.name')) !!}
            {!! Form::input('text','name',null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('controller',trans('admin.controller')) !!}
            {!! Form::input('text','controller',null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('icon',trans('admin.icon_class')) !!}
            {!! Form::input('text','icon',null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::submit($submitButtonText,['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>