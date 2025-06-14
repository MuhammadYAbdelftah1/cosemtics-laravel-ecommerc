@php
    $title = $shortcode->title ?? '';
    $subtitle = $shortcode->subtitle ?? '';
    $description = $shortcode->description ?? '';
    $image = $shortcode->image ? RvMedia::getImageUrl($shortcode->image) : '';
    $buttonText = $shortcode->button_text ?? '';
    $buttonUrl = $shortcode->button_url ?? '#';
    $layout = $shortcode->layout ?? 'image-left';
@endphp

@if($title || $subtitle || $description || $image)
<section class="image-text-section py-5">
    <div class="container">
        <div class="row align-items-center">
            @if($layout === 'image-right')
                <!-- Content Left -->
                <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                    <div class="content-area">
                        @if($subtitle)
                            <h5 class="section-subtitle mb-3" style="color: #0989FF; font-size: 16px; font-weight: 500;">
                                {!! BaseHelper::clean($subtitle) !!}
                            </h5>
                        @endif
                        
                        @if($title)
                            <h3 class="section-title mb-4" style="color: #333; font-size: 36px; font-weight: 700; line-height: 1.3;">
                                {!! BaseHelper::clean($title) !!}
                            </h3>
                        @endif
                        
                        @if($description)
                            <div class="section-description mb-4" style="color: #666; font-size: 16px; line-height: 1.6;">
                                {!! BaseHelper::clean($description) !!}
                            </div>
                        @endif
                        
                        @if($buttonText && $buttonUrl)
                            <div class="section-button">
                                <a href="{{ $buttonUrl }}" class="tp-btn tp-btn-2 tp-btn-blue">
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
                
                <!-- Image Right -->
                <div class="col-lg-6 col-md-12">
                    @if($image)
                        <div class="image-area">
                            <img src="{{ $image }}" alt="{{ $title }}" class="img-fluid rounded" style="width: 100%; height: auto;">
                        </div>
                    @endif
                </div>
            @else
                <!-- Image Left -->
                <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                    @if($image)
                        <div class="image-area">
                            <img src="{{ $image }}" alt="{{ $title }}" class="img-fluid rounded" style="width: 100%; height: auto;">
                        </div>
                    @endif
                </div>
                
                <!-- Content Right -->
                <div class="col-lg-6 col-md-12">
                    <div class="content-area">
                        @if($subtitle)
                            <h5 class="section-subtitle mb-3" style="color: #0989FF; font-size: 16px; font-weight: 500;">
                                {!! BaseHelper::clean($subtitle) !!}
                            </h5>
                        @endif
                        
                        @if($title)
                            <h3 class="section-title mb-4" style="color: #333; font-size: 36px; font-weight: 700; line-height: 1.3;">
                                {!! BaseHelper::clean($title) !!}
                            </h3>
                        @endif
                        
                        @if($description)
                            <div class="section-description mb-4" style="color: #666; font-size: 16px; line-height: 1.6;">
                                {!! BaseHelper::clean($description) !!}
                            </div>
                        @endif
                        
                        @if($buttonText && $buttonUrl)
                            <div class="section-button">
                                <a href="{{ $buttonUrl }}" class="tp-btn tp-btn-2 tp-btn-blue">
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
