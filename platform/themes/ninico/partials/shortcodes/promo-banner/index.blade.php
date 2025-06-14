@php
    $title = $shortcode->title ?? '';
    $subtitle = $shortcode->subtitle ?? '';
    $description = $shortcode->description ?? '';
    $backgroundImage = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : '';
    $buttonText = $shortcode->button_text ?? '';
    $buttonUrl = $shortcode->button_url ?? '#';
    $style = $shortcode->style ?? 'left';
@endphp

@if($title || $subtitle || $description || $backgroundImage)
<section class="promo-banner-section py-5" style="background-image: url('{{ $backgroundImage }}'); background-size: cover; background-position: center; background-repeat: no-repeat; position: relative;">
    <div class="banner-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.3);"></div>
    <div class="container">
        <div class="row align-items-center">
            @if($style === 'center')
                <div class="col-lg-8 col-md-10 mx-auto text-center">
                    <div class="promo-content" style="position: relative; z-index: 2; padding: 60px 0;">
                        @if($subtitle)
                            <h5 class="promo-subtitle mb-3" style="color: #fff; font-size: 16px; font-weight: 500;">
                                {!! BaseHelper::clean($subtitle) !!}
                            </h5>
                        @endif
                        
                        @if($title)
                            <h3 class="promo-title mb-4" style="color: #fff; font-size: 36px; font-weight: 700; line-height: 1.3;">
                                {!! BaseHelper::clean($title) !!}
                            </h3>
                        @endif
                        
                        @if($description)
                            <p class="promo-description mb-4" style="color: #fff; font-size: 18px; line-height: 1.6;">
                                {!! BaseHelper::clean($description) !!}
                            </p>
                        @endif
                        
                        @if($buttonText && $buttonUrl)
                            <div class="promo-button">
                                <a href="{{ $buttonUrl }}" class="tp-btn tp-btn-2 tp-btn-white">
                                    {{ $buttonText }}
                                    <span>
                                        <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 7H1M16 7L10 1M16 7L10 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="col-lg-6 {{ $style === 'right' ? 'offset-lg-6' : '' }}">
                    <div class="promo-content" style="position: relative; z-index: 2; padding: 60px 0;">
                        @if($subtitle)
                            <h5 class="promo-subtitle mb-3" style="color: #fff; font-size: 16px; font-weight: 500;">
                                {!! BaseHelper::clean($subtitle) !!}
                            </h5>
                        @endif
                        
                        @if($title)
                            <h3 class="promo-title mb-4" style="color: #fff; font-size: 36px; font-weight: 700; line-height: 1.3;">
                                {!! BaseHelper::clean($title) !!}
                            </h3>
                        @endif
                        
                        @if($description)
                            <p class="promo-description mb-4" style="color: #fff; font-size: 18px; line-height: 1.6;">
                                {!! BaseHelper::clean($description) !!}
                            </p>
                        @endif
                        
                        @if($buttonText && $buttonUrl)
                            <div class="promo-button">
                                <a href="{{ $buttonUrl }}" class="tp-btn tp-btn-2 tp-btn-white">
                                    {{ $buttonText }}
                                    <span>
                                        <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 7H1M16 7L10 1M16 7L10 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endif
