@if (is_plugin_active('ecommerce'))
    <div class="professional-search-bar">
        <form action="{{ route('public.products') }}" class="position-relative form--quick-search"
            data-url="{{ route('public.ajax.search-products') }}" method="GET">
            <div class="professional-search-wrapper">
                <input type="text" name="q" class="professional-search-input input-search-product"
                    placeholder="{{ __('Search products...') }}"
                    value="{{ BaseHelper::stringify(request()->query('q')) }}" autocomplete="off">
                <button type="submit" class="professional-search-btn" title="search">
                    <i class="fal fa-search"></i>
                </button>
            </div>
            <div class="panel--search-result"></div>
        </form>
    </div>
@endif
