<div class="product-info">
	<h2 style="text-align: left;" class="space10 space10 col-xs-12" data-name="product_name">Lead Details</h2>
</div>
<div class="product-info">
  <h3  class="space10 col-sm-3 col-xs-12">Lead Name :</h3>
  <h3  class="space10 col-sm-9 col-xs-12">{{ $item->leadName }}</h3>
</div>
<div class="product-info">
  <h3  class="space10 col-sm-3 col-xs-12">Lead Product : </h3>
  <h3  class="space10 col-sm-9 col-xs-12">{!! $item->leadProductTitle !!}</h3>
</div>
<div class="product-info">
  <h3  class="space10 col-sm-3 col-xs-12">Lead Description : </h3>
  <h3  class="space10 col-sm-9 col-xs-12">{{ $item->leadProductDescription }}</h3>
</div>
<div class="product-info">
  <h3  class="space10 col-sm-3 col-xs-12">Lead Category : </h3>
  <h3  class="space10 col-sm-9 col-xs-12">{{$item->leadCategory}}</h3>
</div>
<div class="product-info">
  <h3  class="space10 col-sm-3 col-xs-12">Lead Generation Source : </h3>
  <h3  class="space10 col-sm-9 col-xs-12">{{ $item->leadGeneratedFrom }}</h3>
</div>
<div class="product-info">
  <h3  class="space10 col-sm-3 col-xs-12">Lead Quantity : </h3>
  <h3  class="space10 col-sm-9 col-xs-12">{{$item->leadProductQty}}</h3>
</div>
<div class="product-info">
  <h3  class="space10 col-sm-3 col-xs-12">Lead Country :</h3>
  <h3  class="space10 col-sm-9 col-xs-12">{{$item->leadCountry}}</h3>
  </div>
<div class="product-info">
  <h3  class="space10 col-sm-3 col-xs-12">Lead Creation Date : </h3>
  <h3  class="space10 col-sm-9 col-xs-12"><?php echo date('d-m-Y', strtotime($item->created_at)); ?></h3>
</div>
<div class="product-info">
  <h3  class="space10 col-sm-3 col-xs-12">Lead Comment : </h3>
  <h3  class="space10 col-sm-9 col-xs-12">{{ $item->leadComment }}</h3>
</div>
<div class="product-info">
  <input type="hidden" name="lead_id" id="lead_id" value="{{ $item->leadId }}">
  <a class="btn btn-primary flat sc-add-to-buyleads" data-link="{{ route('addtobuyleads') }}">
      Add to Dashboard
  </a>
</div>
