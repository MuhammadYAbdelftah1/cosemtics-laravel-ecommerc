@php
    $title = $shortcode->title ?? '';
    $subtitle = $shortcode->subtitle ?? '';
    $description = $shortcode->description ?? '';
    $backgroundImage = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : '';
    $buttonText = $shortcode->button_text ?? '';
    $buttonUrl = $shortcode->button_url ?? '#';
    $style = $shortcode->style ?? 'left';
@endphp

@if ($title || $subtitle || $description || $backgroundImage)
    <section class="promo-banner-section py-5 scroll-animate animate-fast dark-theme-section"
        style="position: relative; background-image: url('{{ asset('offers.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <!-- Remove white overlay completely -->
        <div style="display: none;"></div>
        <div class="container">
            <div class="row align-items-center">
                @if ($style === 'center')
                    <div class="col-lg-12 mx-auto text-center">
                        <div class="promo-content"
                            style="position: relative; z-index: 2; height: 100%; display: flex; flex-direction: column; justify-content: flex-end; align-items: center; padding: 0 0 60px 0;">
                            <!-- Simplified Banner Content - Bottom Center -->
                            <div class="promo-subtitle mb-3"
                                style="background-color: rgba(0, 0, 0, 0.8); color: #ffffff; font-size: 16px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; padding: 8px 20px; border-radius: 25px; display: inline-block; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.2);">
                                LIMITED TIME
                            </div>

                            <h3 class="promo-title mb-4"
                                style="background-color: rgba(0, 0, 0, 0.8); color: #ffffff; font-size: 22px; font-weight: 700; line-height: 1.4; padding: 16px 24px; border-radius: 15px; display: inline-block; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.2); margin: 15px auto;">
                                Get 20% off on all skincare products
                            </h3>

                            <div class="promo-button mt-3">
                                <a href="{{ $buttonUrl ?: '#' }}" class="tp-btn tp-btn-2"
                                    style="background-color: #ffffff; color: #000000; border: 2px solid #ffffff; padding: 15px 35px; border-radius: 8px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; font-size: 16px;">
                                    Shop Sale
                                    <span>
                                        <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 7H1M16 7L10 1M16 7L10 13" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-12">
                        <div class="promo-content"
                            style="position: relative; z-index: 2; height: 100%; display: flex; flex-direction: column; justify-content: flex-end; align-items: center; padding: 0 0 60px 0; text-align: center;">
                            <!-- Simplified Banner Content - Bottom Center -->
                            <div class="promo-subtitle mb-3"
                                style="background-color: rgba(0, 0, 0, 0.8); color: #ffffff; font-size: 16px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; padding: 8px 20px; border-radius: 25px; display: inline-block; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.2);">
                                LIMITED TIME
                            </div>

                            <h3 class="promo-title mb-4"
                                style="background-color: rgba(0, 0, 0, 0.8); color: #ffffff; font-size: 22px; font-weight: 700; line-height: 1.4; padding: 16px 24px; border-radius: 15px; display: inline-block; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.2); margin: 15px auto;">
                                Get 20% off on all skincare products
                            </h3>

                            <div class="promo-button mt-3">
                                <a href="{{ $buttonUrl ?: '#' }}" class="tp-btn tp-btn-2"
                                    style="background-color: #ffffff; color: #000000; border: 2px solid #ffffff; padding: 15px 35px; border-radius: 8px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; font-size: 16px;">
                                    Shop Sale
                                    <span>
                                        <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 7H1M16 7L10 1M16 7L10 13" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
