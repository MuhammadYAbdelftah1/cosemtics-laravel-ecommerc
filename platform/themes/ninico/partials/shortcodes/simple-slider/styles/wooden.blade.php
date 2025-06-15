<div class="tp-slider-area p-relative full-width-slider">
    <div class="swiper-container slider-active">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
                <div class="swiper-slide">
                    <div class="tp-slide-item">
                        <div class="tp-slide-item__content">
                            <div class="tp-slide-item__content-wrapper">
                                @if ($loop->first)
                                    <h4 class="tp-slide-item__sub-title">Skincare</h4>
                                    <h3 class="tp-slide-item__title mb-25">
                                        <span class="desktop-title">Transform Skin</span>
                                        <span class="mobile-title">Transform Skin</span>
                                    </h3>
                                @elseif($loop->iteration == 2)
                                    <h4 class="tp-slide-item__sub-title">Haircare</h4>
                                    <h3 class="tp-slide-item__title mb-25">
                                        <span class="desktop-title">Beautiful Hair</span>
                                        <span class="mobile-title">Beautiful Hair</span>
                                    </h3>
                                @else
                                    <h4 class="tp-slide-item__sub-title">Beauty</h4>
                                    <h3 class="tp-slide-item__title mb-25">
                                        <span class="desktop-title">Complete Solutions</span>
                                        <span class="mobile-title">Complete Solutions</span>
                                    </h3>
                                @endif
                                <a class="tp-slide-item__slide-btn tp-btn" href="/shop">
                                    Shop Now <i class="fal fa-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="tp-slide-item__img">
                            @include(Theme::getThemeNamespace(
                                    'partials.shortcodes.simple-slider.includes.image',
                                    compact('slider')))
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="slider-pagination"></div>
</div>
