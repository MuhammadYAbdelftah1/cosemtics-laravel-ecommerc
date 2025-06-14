@php
    $title = $shortcode->title ?? '';
    $subtitle = $shortcode->subtitle ?? '';
    $backgroundImage = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : '';
    $buttonText = $shortcode->button_text ?? '';
    $buttonUrl = $shortcode->button_url ?? '#';
    $textColor = $shortcode->text_color ?? 'white';
@endphp

@if ($title || $subtitle || $backgroundImage)
    <section class="full-banner-section"
        style="background-image: url('{{ $backgroundImage }}'); background-size: cover; background-position: center; background-repeat: no-repeat; position: relative;">
        <div class="banner-overlay"
            style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.4);"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-10 mx-auto text-center">
                    <div class="banner-content" style="position: relative; z-index: 2;">
                        @if ($subtitle)
                            <h5 class="banner-subtitle mb-3"
                                style="color: {{ $textColor === 'white' ? '#fff' : '#333' }}; font-size: 18px; font-weight: 500;">
                                {!! BaseHelper::clean($subtitle) !!}
                            </h5>
                        @endif

                        @if ($title)
                            <h2 class="banner-title mb-4"
                                style="color: {{ $textColor === 'white' ? '#fff' : '#333' }}; font-size: 48px; font-weight: 700; line-height: 1.2;">
                                {!! BaseHelper::clean($title) !!}
                            </h2>
                        @endif

                        @if ($buttonText && $buttonUrl)
                            <div class="banner-button mt-4">
                                <a href="{{ $buttonUrl }}" class="tp-btn tp-btn-2 tp-btn-blue">
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

    <!-- Divider Section -->
    <div class="banner-divider"
        style="height: 60px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); position: relative;">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="divider-line"
                style="width: 100px; height: 2px; background: linear-gradient(90deg, #0989FF 0%, #06b6d4 100%); border-radius: 2px;">
            </div>
        </div>
    </div>
@endif
