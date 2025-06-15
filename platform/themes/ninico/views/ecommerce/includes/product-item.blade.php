<div class="tpproduct pb-15 mb-30">
    <div class="tpproduct__thumb p-relative">
        <div class="product__badge-list">
            @if ($product->isOutOfStock())
                <span class="tpproduct__thumb-topsall" style="background-color: #ff0000">
                    <span class="product__badge-item">{{ __('Out of stock') }}</span>
                </span>
            @else
                @if ($product->isOnSale() && $product->sale_percent)
                    <span class="tpproduct__thumb-topsall"
                        style="background-color: #ffffff; color: #000000; border: 1px solid #000000;">
                        <span class="product__badge-item"
                            style="color: #000000;">{{ __(':percent% off', ['percent' => $product->sale_percent]) }}</span>
                    </span>
                @endif
                @if ($product->productLabels->isNotEmpty())
                    @foreach ($product->productLabels as $label)
                        <span class="tpproduct__thumb-topsall" {!! $label->css_styles !!}>
                            <span class="product__badge-item">{{ $label->name }}</span>
                        </span>
                    @endforeach
                @endif
            @endif
        </div>
        <a href="{{ $product->url }}">
            <img src="{{ RvMedia::getImageUrl($product->image, 'small', false, RvMedia::getDefaultImage()) }}"
                alt="{{ $product->name }}">
            <img class="product-thumb-secondary"
                src="{{ RvMedia::getImageUrl(Arr::get($product->images, 2, $product->image), 'small', false, RvMedia::getDefaultImage()) }}"
                alt="{{ $product->name }}">
        </a>
        @if (EcommerceHelper::isCompareEnabled() ||
                theme_option('enable_quick_view', 'yes') === 'yes' ||
                EcommerceHelper::isWishlistEnabled())
            <div class="tpproduct__thumb-action">
                @if (EcommerceHelper::isCartEnabled())
                    @if ($product->variations()->exists())
                        <a data-id="{{ $product->slug }}" href="#"
                            data-url="{{ route('public.ajax.quick-shop', $product->slug) }}" class="button-quick-shop">
                            <i class="fal fa-shopping-cart"></i>
                        </a>
                    @else
                        <a data-id="{{ $product->id }}" href="#"
                            data-url="{{ route('public.cart.add-to-cart') }}" class="add-to-cart">
                            <i class="fal fa-shopping-cart"></i>
                        </a>
                    @endif
                @endif
                @if (theme_option('enable_quick_view', 'yes') === 'yes')
                    <a class="quickview" href="#"
                        data-url="{{ route('public.ajax.quick-view', $product->id) }}"><i class="fal fa-eye"></i></a>
                @endif
                @if (EcommerceHelper::isWishlistEnabled())
                    <a class="wishlist add-to-wishlist" href="#"
                        data-url="{{ route('public.wishlist.add', $product->getKey()) }}"><i
                            class="fal fa-heart"></i></a>
                @endif
        @endif
    </div>
</div>
<div class="tpproduct__content">
    <h3 class="tpproduct__title text-truncate">
        <a href="{{ $product->url }}" title="{{ $product->name }}">{{ $product->name }}</a>
    </h3>

    {{-- Reviews/Stars UI removed as requested --}}

    <div class="tpproduct__priceinfo p-relative">
        <div class="tpproduct__priceinfo-list">
            @include(EcommerceHelper::viewPath('includes.product-price'), [
                'product' => $product,
                'priceOriginalClassName' => 'tpproduct__priceinfo-list-oldprice',
            ])
        </div>
        @if (EcommerceHelper::isCartEnabled())
            <div class="tpproduct__cart">
                @if ($product->variations()->exists())
                    <a data-id="{{ $product->slug }}" href="#"
                        data-url="{{ route('public.ajax.quick-shop', $product->slug) }}" class="button-quick-shop">
                        <i class="fal fa-shopping-cart"></i>
                        <span>{{ __('Select options') }}</span>
                    </a>
                @else
                    <a data-id="{{ $product->id }}" href="#" data-url="{{ route('public.cart.add-to-cart') }}"
                        class="add-to-cart">
                        <i class="fal fa-shopping-cart"></i>
                        <span>{{ __('Add To Cart') }}</span>
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
</div>
