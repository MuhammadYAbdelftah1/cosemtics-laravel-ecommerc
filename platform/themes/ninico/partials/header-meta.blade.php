@if (is_plugin_active('ecommerce'))
    <div @class(['header-meta d-flex align-items-center', $class ?? null])>
        <div class="header-meta__social d-flex align-items-center ml-25">
            @php
                $currencies = get_all_currencies();
            @endphp
            @if (isset($currencies) && count($currencies) > 1)
                <div class="header-currency-switcher">
                    <div class="headertoplag__lang">
                        <ul>
                            <li>
                                <button>
                                    @php
                                        $currentCurrency = get_application_currency()->title;
                                        $flagIcon =
                                            $currentCurrency === 'EGP'
                                                ? '🇪🇬'
                                                : ($currentCurrency === 'USD'
                                                    ? '🇺🇸'
                                                    : '🌍');
                                    @endphp
                                    <span class="currency-flag">{{ $flagIcon }}</span>
                                    {{ $currentCurrency }}
                                    <span><i class="fal fa-angle-down"></i></span>
                                </button>
                                <ul class="header-meta__lang-submenu">
                                    @foreach ($currencies as $currency)
                                        <li>
                                            @php
                                                $currencyFlag =
                                                    $currency->title === 'EGP'
                                                        ? '🇪🇬'
                                                        : ($currency->title === 'USD'
                                                            ? '🇺🇸'
                                                            : '🌍');
                                            @endphp
                                            <a href="{{ route('public.change-currency', $currency->title) }}">
                                                <span class="currency-flag">{{ $currencyFlag }}</span>
                                                {{ $currency->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
            @if (EcommerceHelper::isCartEnabled())
                <button class="header-cart p-relative tp-cart-toggle" title="cart">
                    <i class="fal fa-shopping-cart"></i>
                    <span class="tp-product-count">{{ Cart::instance('cart')->count() }}</span>
                </button>
            @endif
            @if (EcommerceHelper::isCompareEnabled())
                <a href="#" data-url="{{ route('public.compare') }}" class="header-cart p-relative">
                    <i class="fal fa-exchange"></i>
                    <span class="tp-product-compare-count">{{ Cart::instance('compare')->count() }}</span>
                </a>
            @endif
            @if (EcommerceHelper::isWishlistEnabled())
                <a href="{{ route('public.wishlist') }}" class="header-cart p-relative">
                    <i class="fal fa-heart"></i>
                    <span class="tp-product-wishlist-count">{{ Cart::instance('wishlist')->count() }}</span>
                </a>
            @endif
            @auth('customer')
                <a href="{{ route('customer.overview') }}" title="{{ auth('customer')->user()->name }}"><i
                        class="fal fa-user"></i></a>
            @else
                <a href="{{ route('customer.login') }}" title="{{ __('Login') }}"><i class="fal fa-user"></i></a>
            @endauth
        </div>
    </div>
@endif
