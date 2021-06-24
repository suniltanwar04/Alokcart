<div class="container filter-wrapper">
    <div class="row">
        <div class="col-md-12 ">
            <span>
                <select name="sort_by" class="selectBoxIt" id="filter_opt_sort">
                    <option value="">All</option>
                    <option value="2" {{ Request::get('sort_by') == '2' ? 'selected' : '' }}>Latest RFQ</option>
                </select>
            </span>
            <span class="pull-right text-muted">
              <a href="/buy-leads" class="btn btn-primary btn-sm flat">
                <span>Reset</span>
              </a>
              <a href="#" class="viewSwitcher btn btn-default btn-sm flat">
                <i class="fa fa-th" data-toggle="tooltip" title="@lang('theme.grid_view')"></i>
              </a>
              <a href="#" class="viewSwitcher btn btn-primary btn-sm flat">
                <i class="fa fa-list" data-toggle="tooltip" title="@lang('theme.list_view')"></i>
              </a>
            </span>
        </div>
    </div>
</div><!-- /.filter-wrapper -->

<div class="clearfix space20"></div>