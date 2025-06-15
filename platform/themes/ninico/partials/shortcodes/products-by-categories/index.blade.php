<section class="selected-product-area pt-70 pb-50">
    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-xxl-3 col-lg-6 col-md-6">
                    <div class="tpselectproduct">
                        <h4 class="tpselectproduct__heading mb-35">{{ $category->name }}</h4>
                        @foreach ($category->products as $product)
                            <div class="tpselectproduct__item d-flex align-items-center mb-25">
                                <div class="tpselectproduct__thumb mr-25 p-relative">
                                    <img src="{{ RvMedia::getImageUrl($product->image, 'small') }}"
                                        alt="{{ $product->name }}">
                                    @if (EcommerceHelper::isCompareEnabled() ||
                                            theme_option('enable_quick_view', 'yes') === 'yes' ||
                                            EcommerceHelper::isWishlistEnabled())
                                        <div class="tpproduct__thumb-action">
                                            @if (EcommerceHelper::isCartEnabled())
                                                @if ($product->variations()->exists())
                                                    <a data-id="{{ $product->slug }}" href="#"
                                                        data-url="{{ route('public.ajax.quick-shop', $product->slug) }}"
                                                        class="button-quick-shop">
                                                        <i class="fal fa-shopping-cart"></i>
                                                    </a>
                                                @else
                                                    <a data-id="{{ $product->id }}" href="#"
                                                        data-url="{{ route('public.cart.add-to-cart') }}"
                                                        class="add-to-cart">
                                                        <i class="fal fa-shopping-cart"></i>
                                                    </a>
                                                @endif
                                            @endif
                                            @if (theme_option('enable_quick_view', 'yes') === 'yes')
                                                <a class="quickview" href="#"
                                                    data-url="{{ route('public.ajax.quick-view', $product->id) }}"><i
                                                        class="fal fa-eye"></i></a>
                                            @endif
                                            @if (EcommerceHelper::isWishlistEnabled())
                                                <a class="wishlist add-to-wishlist" href="#"
                                                    data-url="{{ route('public.wishlist.add', $product->getKey()) }}"><i
                                                        class="fal fa-heart"></i></a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="tpselectproduct__content">
                                    <div class="tpproduct-details__rating">
                                        <div class="product-rating-wrapper">
                                            <div class="product-rating"
                                                style="width: {{ $product->reviews_avg_star * 20 }}%"></div>
                                        </div>
                                    </div>
                                    <h4 class="tpselectproduct__title">
                                        <a href="{{ $product->url }}">{{ $product->name }}</a>
                                    </h4>
                                    <div class="tpselectproduct__price">
                                        @include(EcommerceHelper::viewPath('includes.product-price'), [
                                            'product' => $product,
                                            'priceOriginalClassName' => 'tpproduct__priceinfo-list-oldprice small',
                                        ])
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
