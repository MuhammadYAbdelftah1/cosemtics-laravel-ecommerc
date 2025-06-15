<header class="main-header">
    <div class="main-menu-area d-none d-xl-block">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    {!! Theme::partial('logo') !!}
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="main-menu">
                        <nav id="mobile-menu">
                            {!! Menu::renderMenuLocation('main-menu', ['view' => 'menu']) !!}
                        </nav>
                    </div>
                </div>
                @if (is_plugin_active('ecommerce'))
                    <div class="col-auto">
                        <div class="header-meta d-flex align-items-center">
                            <div class="professional-search-container me-3">
                                {!! Theme::get('headerSearchBar') !!}
                            </div>
                            {!! Theme::partial('header-meta') !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>

{!! Theme::partial('navbar') !!}
