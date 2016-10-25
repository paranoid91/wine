@if(!empty($roles))
    {!! Form::hidden('id',null) !!}
    {!! Form::hidden('verify',1) !!}
<div class="row" style="margin-bottom:15px;">
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('role',trans('admin.group')) !!}
            <div class="select">
                {!! Form::select('role',$roles,$selected_role,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('name',trans('admin.username')) !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('email',trans('admin.email')) !!}
            {!! Form::text('email',null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('password',trans('admin.password')) !!}
            {!! Form::password('password',['class'=>'form-control','placeholder'=>'******']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('password_confirmation',trans('admin.password_repeat')) !!}
            {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'******']) !!}
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