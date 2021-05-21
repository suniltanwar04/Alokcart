@extends('admin.layouts.master')
@section('content')
	<div class="box">
	    <div class="box-header with-border">
		  <h3 class="box-title">{{ trans('Lead Detail') }}</h3>
            <span class="pull-right"><a href="{{url('/admin/leads')}}" class="btn btn-danger btn-md">View All Leads</a></span>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-2nd-no-sort datatable" id="sortable" >
	        <thead>
		        <tr>
                    <th>{{ trans('app.#') }}</th>
                    <th>{{ trans('app.date') }}</th>
                    <th>{{ trans('Lead Name') }}</th>
                    <th>{{ trans('Quantity') }}</th>
                    <th >{{ trans('Lead Country') }}</th>                 
                    <th>{{ trans('Seller') }}</th>					
                    <th>{{ trans('Feedback') }}</th>
                    <th>{{ trans('Status') }}</th>
					
		        </tr>
	        </thead>
	        <tbody id="massSelectArea">
		        @foreach($allSellerAction as $leads )
			        <tr id="{{ $leads->feedbackId }}">
				        <td>
							<a href="#" target=""><span>{{ $leads->feedbackId }}</span></a>
                        </td>
                        <td>
							<span>{{ trans(date('d M, Y',strtotime($leads->feedbackDated))) }}</span>
                        </td>
                        <td>
							<span>{{ ($leads->leadName) }}</span>
                        </td>
                        <td>
							<span>{{ ($leads->leadName) }}</span>
                        </td>
                        <td>
							<span>{{ ($leads->leadCountry) }}</span>
                        </td>
						
                        <td>
							<span>{{ ($leads->name) }}</span>
                        </td>
						
                           
                        <td>

                            <span>{{ $leads->feedbackText}}</span>
                        </td>
                        <td>

                                <span>{{ $sellerLeadStatus[$leads->feedbackStatus]}}</span>
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