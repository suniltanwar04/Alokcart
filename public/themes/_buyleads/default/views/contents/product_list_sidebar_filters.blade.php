{{-- <button id="filterBtn" class="btn btn-sm btn-default">Filters</button> --}}
<button type="button" id="filterBtn">
    <span class="sr-only">Filters</span>
    <i class="fa fa-filter"></i>
</button>

<aside class="category-filters">

    @include('partials._categories_filter')

    {{-- Country --}}
    <div class="category-filters-section">
        <h3>Countries
            @if(Request::has('country'))
                <a href="#" data-name="country" class="clear-filter small text-lowercase pull-right">@lang('theme.button.clear')</a>
            @endif
        </h3>
        <ul class="cateogry-filters-list">
            @foreach ($countries as $cntry_ky => $country)
                <li class="<?php echo ($cntry_ky < 6)?'show_data':'hide_data';?>">
                    <a href="#" data-name="country" data-value="{{$country}}" class="link-filter-opt product-info-rating">
                        <span class="small {{ Request::get('country') == $country ? 'active' : '' }}">{{$country}}</span>
                    </a>
                </li>
                @if($cntry_ky == 6)
                <li class="view_more_button">
                    <a href="#" class="view_more_button">
                        <span>View More</span>
                    </a>
                </li>
                @endif
            @endforeach
        </ul>
    </div>

    {{-- price --}}
    <div class="category-filters-section">
        <h3>Date
            @if(Request::has('days'))
                <a href="#" data-name="days" class="clear-filter small text-lowercase pull-right">@lang('theme.button.clear')</a>
            @endif
        </h3>
        <ul class="cateogry-filters-list space20">
            <li>
                <a href="#" data-name="days" data-value="1" class="link-filter-opt {{ Request::get('days') == '1' ? 'active' : '' }}">
                    <span class="">
                        Last 24 Hours
                    </span>
                </a>
            </li>
            <li>
                <a href="#" data-name="days" data-value="3" class="link-filter-opt {{ Request::get('days') == '3' ? 'active' : '' }}">
                    <span class="">
                        Last 3 dAYS
                    </span>
                </a>
            </li>
            <li>
                <a href="#" data-name="days" data-value="7" class="link-filter-opt {{ Request::get('days') == '7' ? 'active' : '' }}">
                    <span class="">
                        Last 7 Days
                    </span>
                </a>
            </li>
            <li>
                <a href="#" data-name="days" data-value="30" class="link-filter-opt {{ Request::get('days') == '30' ? 'active' : '' }}">
                    <span class="">
                        Last 30 Days
                    </span>
                </a>
            </li>
        </ul>
    </div>
</aside>