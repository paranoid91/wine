<!-- Modal -->
<div id="TotalModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{trans('admin.total')}}</h4>
            </div>
            <div class="modal-body">
                {!! Form::label('total',trans('admin.desc')) !!}
                {!! Form::textarea('total',null,['class'=>'form-control']) !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" data-route="">{{trans('admin.save')}}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('admin.close')}}</button>
            </div>
        </div>
    </div>
</div>