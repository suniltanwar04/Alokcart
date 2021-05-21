<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body" style="padding: 0px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>
            <div class="col-md-12 nopadding">
				<table class="table no-border">
					<tr>
						<th class="text-right">{{ trans('app.name') }}:</th>
						<td >{{ $leads->leadName }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.email') }}:</th>
						<td >{{ $leads->leadEmail }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.contact') }}:</th>
						<td >{{ $leads->leadContact }}</td>
					</tr>
					<tr>
						<th class="text-right">Product Name:</th>
						<td >{{ $leads->leadProduct }}</td>
					</tr>
					<tr>
						<th class="text-right">Product Title:</th>
						<td >{{ $leads->leadProductTitle }}</td>
					</tr>
					<tr>
						<th class="text-right">Product Description:</th>
						<td >{{ $leads->leadProductDescription }}</td>
					</tr>
					<tr>
						<th class="text-right">Quantity:</th>
						<td >{{ $leads->leadProductQty }}</td>
					</tr>
					<tr>
						<th class="text-right">Country:</th>
						<td >{{ $leads->leadCountry }}</td>
					</tr><tr>
						<th class="text-right">Comment:</th>
						<td >{{ $leads->leadComment }}</td>
					</tr>
					<tr>
						<th class="text-right">Lead Generated From:</th>
						<td >{{ $leads->leadGeneratedFrom }}</td>
					</tr>
					<tr>
						<th class="text-right">Lead Type:</th>
						<td >{{ $leads->lead_type }}</td>
					</tr>
				</table>
			</div>
			<div class="clearfix"></div>
        </div>
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->