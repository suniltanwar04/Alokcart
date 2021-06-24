<nav class="navbar navbar-default navbar-main navbar-light navbar-top">
  <div class="container">
    <div class="navbar-header brand-centered">
      <a class="navbar-brand" href="{{ url('/') }}">
        @if( Storage::exists('logo.png') )
          <img src="{{ get_storage_file_url('logo.png', 'full') }}" class="brand-logo" alt="{{ trans('app.logo') }}" title="{{ trans('app.logo') }}">
        @else
          <img src="https://placehold.it/140x60/eee?text={{ get_platform_title() }}" alt="{{ trans('app.logo') }}" title="{{ trans('app.logo') }}" />
        @endif
      </a>
    </div>
    {!! Form::open(['route' => 'buylead', 'method' => 'GET', 'id' => 'search-categories-form', 'class' => 'navbar-left navbar-form navbar-search', 'role' => 'search']) !!}
      <select name="insubgrp" class="search-category-select ">
        <option value="all">Product/Service</option>
        @foreach($search_category_list as $search_category_grp)
          <optgroup label="{{ $search_category_grp->name }}">
            @foreach($search_category_grp->subGroups as $search_category)
              <option value="{{ $search_category->slug }}"
                @if(Request::has('insubgrp'))
                 {{ Request::get('insubgrp') == $search_category->slug ? ' selected' : '' }}
                @endif
              >{{ $search_category->name }}</option>
            @endforeach
          </optgroup>
        @endforeach
      </select>
      <div class="form-group">
        {!! Form::text('q', Request::get('q'), ['class' => 'form-control', 'placeholder' => 'I am looking for']) !!}
      </div>
      <a class="fa fa-search navbar-search-submit" onclick="document.getElementById('search-categories-form').submit()"></a>
    {!! Form::close() !!}
    <ul class="nav navbar-nav navbar-right navbar-mob-left">
      <div class="navbar-header">
          <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#main-nav-collapse" area_expanded="false">
            <span class="sr-only">{{ trans('theme.nav.menu') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
      </div>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ get_page_url(\App\Page::PAGE_CONTACT_US) }}" class="navbar-item-mergin-top" target="_blank">{{ trans('theme.nav.support') }}</a>
        </li>
        @if(count(config('active_locales')) > 1)
          <li class="dropdown lang-dropdown">
            <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
              <span>{{ trans('theme.nav.lang') }}</span>
              <i class="fa fa-globe"></i>
              {{ config('active_locales')->firstWhere('code', App::getLocale())->language }}
            </a>
            <ul class="dropdown-menu">
              @foreach(config('active_locales') as $lang)
                <li class="{{$lang->code == \App::getLocale() ? 'selected' : ''}}">
                  <a href="{{route('locale.change', $lang->code)}}">
                    <img src="{{asset(sys_image_path('flags') . array_slice(explode('_', $lang->php_locale_code), -1)[0] . '.png')}}" class="lang-flag">
                    {{ $lang->language }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endif
      </ul>
  </div>
</nav>