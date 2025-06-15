@if (theme_option('sticky_header_enabled', 'yes') == 'yes')
    <div id="header-sticky" class="logo-area tp-sticky-one mainmenu-5">
        {!! Theme::partial('header-middle') !!}
    </div>
@endif

<div id="header-tab-sticky" class="tp-md-lg-header d-none d-md-block d-xl-none pt-30 pb-30">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 d-flex align-items-center">
                <div class="flex-auto header-canvas">
                    <button class="tp-menu-toggle" title="open">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="menu-toggle-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
                <div class="logo">
                    <a href="{{ BaseHelper::getHomepageUrl() }}">
                        <img src="{{ asset('storage/logo-white.png') }}" alt="{{ theme_option('site_title') }}"
                            style="max-height: 35px; height: auto;">
                    </a>
                </div>
            </div>
            @if (is_plugin_active('ecommerce'))
                <div class="col-lg-9 col-md-8">
                    <div class="header-meta-info d-flex align-items-center justify-content-between">
                        {!! Theme::get('headerSearchBar') !!}
                        <div class="header-meta__social d-flex align-items-center ml-25">
                            @if (EcommerceHelper::isCartEnabled())
                                <button class="header-cart p-relative tp-cart-toggle" title="search">
                                    <i class="fal fa-shopping-cart"></i>
                                    <span class="tp-product-count">{{ Cart::instance('cart')->count() }}</span>
                                </button>
                            @endif

                            @if (EcommerceHelper::isCompareEnabled())
                                <a href="{{ route('public.compare') }}" class="header-cart p-relative">
                                    <i class="fal fa-exchange"></i>
                                    <span
                                        class="tp-product-compare-count">{{ Cart::instance('compare')->count() }}</span>
                                </a>
                            @endif

                            @auth('customer')
                                <a href="{{ route('customer.overview') }}" title="{{ auth('customer')->user()->name }}"><i
                                        class="fal fa-user"></i></a>
                            @else
                                <a href="{{ route('customer.login') }}" title="{{ __('Login') }}"><i
                                        class="fal fa-user"></i></a>
                            @endauth

                            @if (EcommerceHelper::isWishlistEnabled())
                                <a href="{{ route('public.wishlist') }}"><i class="fal fa-heart"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<div @if (theme_option('sticky_header_mobile_enabled', 'yes') == 'yes') id="header-mob-sticky" @endif @class([
    'tp-md-lg-header d-md-none pt-20 pb-20',
    $headerMobileStickyClass ?? null,
])>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-3 d-flex align-items-center">
                <div class="flex-auto header-canvas">
                    <button class="tp-menu-toggle" title="open">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="menu-toggle-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="col-6">
                <div class="text-center">
                    <div class="logo">
                        <a href="{{ BaseHelper::getHomepageUrl() }}">
                            <img src="{{ asset('storage/logo-white.png') }}" alt="{{ theme_option('site_title') }}"
                                style="max-height: 35px; height: auto;">
                        </a>
                    </div>
                </div>
            </div>
            @if (is_plugin_active('ecommerce'))
                <div class="col-3">
                    <div class="header-meta-info d-flex align-items-center justify-content-end ml-25">
                        @if (EcommerceHelper::isCartEnabled())
                            <button class="mobile-header-cart p-relative tp-cart-toggle" title="cart">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="mobile-cart-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <span class="mobile-cart-count">{{ Cart::instance('cart')->count() }}</span>
                            </button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="tpsideinfo">
    <button class="tpsideinfo__close">
        {{ __('Close') }}
        <i class="ml-10 fal fa-times"></i>
    </button>

    <!-- Mobile Menu Logo -->
    <div class="tpsideinfo__logo text-center mb-4 mt-20">
        <img src="{{ asset('storage/logo-white.png') }}" alt="{{ theme_option('site_title') }}"
            style="max-width: 150px; height: auto;">
    </div>

    <div class="tpsideinfo__nabtab mb-4">
        {!! Theme::partial('mobile.menu-tab-content') !!}
    </div>

    @if (is_plugin_active('ecommerce'))
        {{-- Mobile Menu Divider --}}
        <div class="mobile-menu-divider"></div>

        @if (EcommerceHelper::isOrderTrackingEnabled())
            <div class="tpsideinfo__wishlist-link">
                <a href="{{ route('public.orders.tracking') }}">
                    <i class="fal fa-truck"></i> {{ __('Order Tracking') }}
                </a>
            </div>
        @endif

        <div class="tpsideinfo__account-link">
            @auth('customer')
                <a href="{{ route('customer.overview') }}" title="{{ auth('customer')->user()->name }}"><i
                        class="fal fa-user"></i> {{ auth('customer')->user()->name }}</a>
            @else
                <a href="{{ route('customer.login') }}" title="{{ __('Login') }}"><i class="fal fa-user"></i>
                    {{ __('Login / Register') }}</a>
            @endauth
        </div>
    @endif

    <div class="tpsideinfo__switcher navbar-collapse collapse show mb-4" id="navbarSupportedContent" style="">
        <ul class="mb-2 navbar-nav me-auto mb-lg-0">
            {!! Theme::partial('language-switcher', ['mobile' => true]) !!}
            {!! Theme::partial('currency-switcher', ['mobile' => true]) !!}
        </ul>
    </div>
</div>

<div class="body-overlay"></div>

<div class="tpcartinfo tp-cart-info-area p-relative">
    <button class="tpcart__close" title="close">
        <i class="fal fa-times"></i>
    </button>
    <div class="tpcart">
        <h4 class="tpcart__title">{{ __('Your Cart') }}</h4>
        <div class="tpcart__product">
            @include(Theme::getThemeNamespace('views.ecommerce.includes.mini-cart'))
        </div>
        @if ($cartFooterDescription = theme_option('cart_footer_description'))
            <div class="text-center tpcart__free-shipping">
                <span>{!! BaseHelper::clean($cartFooterDescription) !!}</span>
            </div>
        @endif
    </div>
</div>

<div class="tpsideinfo tpsidecategories">
    <button class="tpsideinfo__close">
        {{ __('Close') }}
        <i class="ml-10 fal fa-times"></i>
    </button>

    <div class="tpsideinfo__nabtab mt-30 mb-4">
        {!! Theme::partial('mobile.categories-tab-content', compact('categories')) !!}
    </div>
</div>

{{-- Search sidebar removed - desktop header search is sufficient --}}

<div class="cartbody-overlay"></div>
