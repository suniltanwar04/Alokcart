<div class="modal-dialog modal-lg">
    <div class="modal-content">
        {!! Form::model($leads, ['method' => 'PUT', 'route' => ['admin.leads.lead.update', $leads->leadId], 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
            <div class="form-group">
              {!! Form::label('leadReport', 'Report Text', ['class' => 'with-help']) !!}
              {!! Form::textarea('leadReport', null, ['class' => 'form-control summernote-without-toolbar', 'placeholder' => trans('app.placeholder.meta_description'), 'rows' => '1']) !!}
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->