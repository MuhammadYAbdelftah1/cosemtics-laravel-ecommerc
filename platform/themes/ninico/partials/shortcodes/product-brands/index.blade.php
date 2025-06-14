<section class="category-area pt-70 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tpsection mb-40 text-center">
                    <h2 class="tpsection__title">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                </div>
            </div>
        </div>
        <div class="brands-layout">
            @foreach ($brands as $brand)
                <div class="brand-item mb-40">
                    <a href="{{ $brand->website ?: '#' }}">
                        <div class="tpcategory__icon p-relative">
                            @if ($brand->logo)
                                <img src="{{ RvMedia::getImageUrl($brand->logo, default: RvMedia::getDefaultImage()) }}"
                                    alt="{{ $brand->name }}">
                            @else
                                <i class="fas fa-tag"></i>
                            @endif
                            <span style="display: none;">{{ number_format($brand->products_count) }}</span>
                        </div>
                    </a>
                    <div class="tpcategory__content">
                        <p class="tpcategory__title">
                            <a href="{{ $brand->website ?: '#' }}">{{ $brand->name }}</a>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
