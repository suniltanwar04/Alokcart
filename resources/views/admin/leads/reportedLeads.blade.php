@extends('admin.layouts.master')
@section('content')
	<div class="box">
	    <div class="box-header with-border">
		  <h3 class="box-title">{{ trans('All leads') }}</h3>
		  <span class="pull-right">
				{{ Form::open(['url'=>'/admin/leads/bulkuploadleads/','files' => true ])}}
					<button class="btn btn-md btn-info" type="button" id="importLeadButton"><i class = "fa fa-file"></i> Import</button>
					<input onchange="this.form.submit()" type="file" name="importFile" id="importFile" style="display:none;">
				{{ Form::close()}}
		  </span>
		  <span class="pull-right">
				<a class="btn btn-md btn-info" href="{{url('/admin/leads/reportedLeads')}}"><i class = "fa fa-trash"></i> Reset Filter</a>
	  	</span>
		  <style>
					#leadDateFilter li{
						margin: 0px 5px;
					}
					.filterContainer input, .filterContainer select{
						max-height: 32px !important;
					}
			  </style>
			<span class="pull-right filterContainer" id="leadDateFilter">
				{{ Form::open(['url'=>'/admin/leads/reportedLeads/','method' => 'get' ])}}
				<ul style="display: inline-flex;list-style: none;">
						<li><input type="date" name="from" class="form-control" placeholder="Select From Date"></li>
						<li><input type="date" name="to" class="form-control" placeholder="Select From Date"></li>
						<li><button class="btn btn-danger btn-md"><i class="fa fa-search"></i></button>
						</li>
				</ul>
				{{ Form::close()}}
			</span>
			<span class="pull-right filterContainer" id="leadDateFilter">
				{{ Form::open(['url'=>'/admin/leads/reportedLeads/','method' => 'get' ])}}
					<select class="form-control" name="leadCountry" onchange="this.form.submit()">
						<optgroup label="Select Country"></optgroup>
						<option value="">Reset</option>
						@foreach ($country as $item)
							<option @if ($leadCountry==$item->leadCountry) selected 								
							@endif value="{{$item->leadCountry}}">{{ $item->leadCountry}}</option>
						@endforeach
					</select>
				{{ Form::close()}}
			</span>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-2nd-no-sort datatable" id="sortable" >
	        <thead>
		        <tr>
					<th width="7px">{{ trans('app.#') }}</th>
					<th width="15%">{{ trans('app.date') }}</th>
					<th width="15%">{{ trans('Country') }}</th>
					<th  width="15%">{{ trans('app.name') }}</th>
					<th  width="15%">{{ trans('app.phone') }}</th>					
					<!-- <th  width="15%">{{ trans('app.email') }}</th> -->
					<th  width="15%">Reported Comments</th>
					<!-- <th  width="15%">{{ trans('app.product') }}</th> -->
					<!-- <th>{{ trans('qty') }}</th> -->
					{{-- @if(Auth::user()->role_id!=3)
						<!-- <th>{{ trans('app.vendor') }}</th>				 -->
					@endif --}}
					@if($leadStatus)
						<!-- <th width="15%">{{ trans('app.status') }}</th> -->
					@endif
					@if(Auth::user()->role_id==3)
						<!-- <th>Feedback</th>	 -->
					@endif
					<th  width="15%">Options</th>
		        </tr>
	        </thead>
	        <tbody id="massSelectArea">
		        @foreach($Leads as $leads )
					<tr id="{{ $leads->leadId }}">
				        <td>
							<a href="{{url('/admin/leads/details?lead='.$leads->leadId)}}" target=""><span>{{ $leads->leadId }}</span></a>
						</td>
						<td>
							<span>{{ trans(date('d M, Y',strtotime($leads->updated_at))) }}</span>
						</td>
						<td>
							<span>{{ ($leads->leadCountry) }}</span>
						</td>
						<td>
							<span>{{ ($leads->leadName) }}</span>
						</td>
						<td>
							<span>{{ ($leads->leadContact) }}</span>
						</td>
						<!-- <td>
							<span>{{ ($leads->leadEmail) }}</span>
						</td> -->
						<td>
							<span>{!! ($leads->leadReport) !!}</span>
						</td>
						<!-- <td>
							<span>
								<a class="link" target="_blank" title="{{ ($leads->leadProduct) }}" href="{{ trans($leads->leadGeneratedFrom) }}">
								{{ ($leads->leadProduct) }}
								</a>
							</span>
						</td> -->
						<!-- <td>
							<span>{{ ($leads->leadProductQty) }}</span>
						</td> -->
						<!-- Admin Lead Status-->

						@if($leadStatus)
							@if(Auth::user()->role_id!=3)
							<!-- <td align="center">
								<span>
									{{Form::open(['url'=>'/admin/leads/updateLeadStatus'])}}
									<input type="hidden" value="{{ $leads->leadId}}" name="leadId">
										<select class="form-control" onchange="this.form.submit()" style="text-transform:capitalize;" name="leadStatus">
											@foreach ($leadStatus as $key=>$status)
												<option @if ($leads->leadStatus == $key) selected @endif value="{{ $key}}">{{ $status}}</option>											
											@endforeach
										</select>
										{{Form::close()}}
								</span>							
							</td> -->
								<!-- Seller Lead Status-->
							@else
							{{Form::open(['url'=>'/admin/leads/updateSellerLead'])}}
							<!-- <td align="center">
								<span>
									<input type="hidden" value="{{ $leads->leadId}}" name="sellerLead">
										<select class="form-control" onchange="this.form.submit()" style="text-transform:capitalize;" name="sellerLeadStatus">
											@foreach ($sellerLeadStatus as $key=>$status)
												<option @if ($leads->leadStatus == $key) selected @endif value="{{ $key}}">{{ $status}}</option>											
											@endforeach
										</select>
								</span>							
							</td>
							<td align="center">
								<textarea class="form-control" name="sellerFeedback" placeholder="Enter Your Feedback"></textarea>
							</td> -->
							{{Form::close()}}
							@endif
						@endif
						<td class="row-options">
							<a href="javascript:void(0)" data-link="{{ route('admin.leads.lead.show', $leads->leadId) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.detail') }}" class="fa fa-expand"></i></a>&nbsp;
							{!! Form::open(['route' => ['admin.leads.lead.unreport', $leads->leadId], 'method' => 'post', 'class' => 'data-form']) !!}
								{!! Form::button('<i class="fa fa-address-card"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => 'Back to Normal', 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
							{!! Form::close() !!}
					</td>
			        </tr>
		        @endforeach
	        </tbody>
	      </table>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
	<style>
.link{color:#3c8dbc !important}
		</style>
@endsection
@section('page-script')
	@include('plugins.drag-n-drop')
@endsection