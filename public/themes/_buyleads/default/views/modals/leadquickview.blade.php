<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content flat">
        <a class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
        <div class="row sc-product-item">
            <div class="col-md-12 col-sm-12">
                <div class="product-single">
                    @include('layouts.product_info', ['zoomID' => 'quickViewZoom', 'item' => $item])
                </div><!-- /.product-single -->

                <div class="space50"></div>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->