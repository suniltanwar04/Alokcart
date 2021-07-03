@include('contents.product_list_top_filter')
<?php 
// echo "<pre>";
// print_r($products);die;
?>
<div class="row product-list">
    @foreach($products['data'] as $item)
        <div class="col-sm-4 col-md-12">
            <div class="product product-list-view sc-product-item">
                {{ Form::hidden('lead_id', $item['leadId'], ['id' => 'lead_id']) }}
                <div class="product-actions btn-group">
                    <a class="btn btn-default btn-sm flat" href="{{ route('quickView.product', $item['leadId']) }}">
                        <i class="fa fa-external-link" data-toggle="tooltip" title="@lang('theme.button.quick_view')"></i> <span>View Details</span>
                    </a>
                    <!-- <a class="btn btn-primary flat sc-add-to-buyleads" data-link="{{ route('addtobuyleads') }}">
                        Add to Dashboard
                    </a> -->
                </div>

                <div class="product-info">
                    <a href="{{ route('quickView.product', $item['leadId']) }}" class="product-info-title" data-name="product_name">{{ $item['leadProductTitle'] }}</a>
                    <div class="product-info-price-new"> {{ $item['leadProductDescription'] }} </div>
                    <div class="product-info-price-new"> {{ $item['leadCountry'] }} </div>
                    <div class="product-info-price-new"> {{ date('d-m-Y',strtotime($item['created_at'])) }} </div>
                </div><!-- /.product-info -->
            </div><!-- /.product -->
        </div><!-- /.col-md-* -->

        @if($loop->iteration % 4 == 0)
            <div class="clearfix"></div>
        @endif
    @endforeach
</div><!-- /.row .product-list -->

<div class="sep"></div>

<div class="row pagenav-wrapper">
    {{ $pagination_data->links('layouts.pagination') }}
</div><!-- /.row .pagenav-wrapper -->