@php
    $title = $shortcode->title ?? '';
    $subtitle = $shortcode->subtitle ?? '';
    $backgroundImage = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : '';
    $buttonText = $shortcode->button_text ?? '';
    $buttonUrl = $shortcode->button_url ?? '#';
    $textColor = $shortcode->text_color ?? 'white';
@endphp

@if ($title || $subtitle || $backgroundImage)
    <section class="full-banner-section scroll-animate animate-fast dark-theme-section bg-black"
        style="position: relative; background-color: #000000 !important; background-image: none !important; min-height: 400px; display: flex; align-items: center;">

        <!-- No overlay needed for solid black background -->
        <div style="display: none;"></div>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-10 mx-auto text-center">
                    <div class="banner-content"
                        style="position: relative; z-index: 2; background-color: #000000 !important; padding: 40px;">
                        @if ($subtitle)
                            <h5 class="banner-subtitle mb-3" style="color: #ffffff; font-size: 18px; font-weight: 500;">
                                {!! BaseHelper::clean($subtitle) !!}
                            </h5>
                        @endif

                        @if ($title)
                            <h2 class="banner-title mb-4"
                                style="color: #ffffff; font-size: 48px; font-weight: 700; line-height: 1.2;">
                                {!! BaseHelper::clean($title) !!}
                            </h2>
                        @endif

                        @if ($buttonText && $buttonUrl)
                            <div class="banner-button mt-4">
                                <a href="{{ $buttonUrl }}" class="tp-btn tp-btn-2"
                                    style="background-color: #ffffff !important; color: #000000 !important; border: 2px solid #ffffff !important; padding: 12px 30px; border-radius: 6px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                                    {{ $buttonText }}
                                    <span>
                                        <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 7H1M16 7L10 1M16 7L10 13" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
