<div class="mobile-menu-container">
    {{-- Mobile Search Bar --}}
    @if (is_plugin_active('ecommerce'))
        <div class="mobile-search-bar mb-20">
            <form action="{{ route('public.products') }}" class="position-relative form--quick-search"
                data-url="{{ route('public.ajax.search-products') }}" method="GET">
                <div class="mobile-search-wrapper">
                    <input type="text" name="q" class="mobile-search-input input-search-product"
                        placeholder="{{ __('Search Products...') }}"
                        value="{{ BaseHelper::stringify(request()->query('q')) }}" autocomplete="off">
                    <button type="submit" class="mobile-search-btn" title="search">
                        <i class="fal fa-search"></i>
                    </button>
                </div>
                <div class="panel--search-result"></div>
            </form>
        </div>
    @endif

    <div class="mobile-menu-bar mb-10">
        <nav class="mobile-menu-nav">
            {!! Menu::renderMenuLocation('main-menu', ['view' => 'mobile-menu']) !!}
        </nav>
    </div>
</div>
