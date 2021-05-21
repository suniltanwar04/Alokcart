<div class="modal-dialog modal-lg">
    <div class="modal-content">
        {!! Form::model($leads, ['method' => 'PUT', 'route' => ['admin.leads.lead.update', $leads->leadId], 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            Edit Leads
        </div>
        <div class="modal-body">
            @include('admin.leads._form')
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->