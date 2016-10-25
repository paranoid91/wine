<div class="row"  style="margin-bottom:15px;">
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('parent',trans('admin.parent').' '.trans('admin.category')) !!}
            {!! Form::selectCat('parent',$categories,null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('name',trans('admin.name')) !!}
            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Category Name']) !!}
            <i><small>({{trans('admin.if_translate')}})</small></i>
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