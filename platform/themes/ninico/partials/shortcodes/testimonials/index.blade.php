@php
    $title = $shortcode->title ?? 'What Our Customers Say';
    $subtitle = $shortcode->subtitle ?? 'Testimonials';
    $backgroundColor = $shortcode->background_color ?? 'light';

    // Use database testimonials if available, otherwise fallback to dummy data
    if (!isset($testimonials) || $testimonials->isEmpty()) {
        $testimonials = collect([
            [
                'name' => 'Sarah Ahmed',
                'company' => 'Skincare Enthusiast',
                'image' => 'https://randomuser.me/api/portraits/women/1.jpg',
                'content' =>
                    'Bs-Derma products have completely transformed my skincare routine. The quality is exceptional and the results are visible within weeks. Highly recommended!',
            ],
            [
                'name' => 'Mona Hassan',
                'company' => 'Beauty Blogger',
                'image' => 'https://randomuser.me/api/portraits/women/2.jpg',
                'content' =>
                    'I have been using Bs-Derma for over a year now. The products are gentle yet effective, perfect for sensitive skin like mine. Amazing results!',
            ],
            [
                'name' => 'Fatima Ali',
                'company' => 'Dermatologist',
                'image' => 'https://randomuser.me/api/portraits/women/3.jpg',
                'content' =>
                    'As a dermatologist, I recommend Bs-Derma to my patients. The formulations are scientifically backed and deliver consistent results.',
            ],
            [
                'name' => 'Layla Omar',
                'company' => 'Satisfied Customer',
                'image' => 'https://randomuser.me/api/portraits/women/4.jpg',
                'content' =>
                    'The customer service is excellent and the products arrive quickly. My skin has never looked better since I started using Bs-Derma.',
            ],
            [
                'name' => 'Nour Mahmoud',
                'company' => 'Makeup Artist',
                'image' => 'https://randomuser.me/api/portraits/women/5.jpg',
                'content' =>
                    'I use Bs-Derma products on my clients and the results are always stunning. The skin looks healthy and radiant. Love this brand!',
            ],
            [
                'name' => 'Amira Youssef',
                'company' => 'Fashion Model',
                'image' => 'https://randomuser.me/api/portraits/women/6.jpg',
                'content' =>
                    'Working in fashion, I need my skin to look perfect. Bs-Derma gives me that confidence with flawless, glowing skin every day.',
            ],
        ]);
    }

    $bgClass = match ($backgroundColor) {
        'white' => 'bg-white',
        'primary' => 'bg-primary text-white',
        default => 'bg-light',
    };
@endphp

<section class="testimonials-section py-5 scroll-animate animate-fast dark-theme-section bg-black"
    style="background-color: #000000;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tpsectionarea text-center mb-5">
                    @if ($subtitle)
                        <h5 class="tpsectionarea__subtitle" style="color: #ffffff;">
                            {!! BaseHelper::clean($subtitle) !!}
                        </h5>
                    @endif
                    @if ($title)
                        <h4 class="tpsectionarea__title" style="color: #ffffff;">
                            {!! BaseHelper::clean($title) !!}
                        </h4>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="testi-active swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $testimonial)
                            @php
                                // Handle both database models and array data
                                $name = is_array($testimonial) ? $testimonial['name'] : $testimonial->name;
                                $company = is_array($testimonial) ? $testimonial['company'] : $testimonial->company;
                                $content = is_array($testimonial) ? $testimonial['content'] : $testimonial->content;
                                $image = is_array($testimonial)
                                    ? $testimonial['image']
                                    : ($testimonial->image
                                        ? (filter_var($testimonial->image, FILTER_VALIDATE_URL)
                                            ? $testimonial->image
                                            : RvMedia::getImageUrl($testimonial->image))
                                        : 'https://randomuser.me/api/portraits/women/' .
                                            (($loop->index % 6) + 1) .
                                            '.jpg');
                            @endphp
                            <div class="swiper-slide">
                                <div class="testimonial-item text-center p-4"
                                    style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.3); margin: 20px 10px;">
                                    <!-- Rating Stars -->
                                    <div class="testimonial-rating mb-3">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star" style="color: #FFD700; font-size: 16px;"></i>
                                        @endfor
                                    </div>

                                    <!-- Testimonial Content -->
                                    <div class="testimonial-content mb-4">
                                        <p
                                            style="font-size: 16px; line-height: 1.6; color: #cccccc; font-style: italic;">
                                            "{{ $content }}"
                                        </p>
                                    </div>

                                    <!-- Customer Info -->
                                    <div class="testimonial-author">
                                        <div class="author-image mb-3">
                                            <img src="{{ $image }}" alt="{{ $name }}"
                                                style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #0989FF;">
                                        </div>
                                        <h5
                                            style="color: #ffffff; font-size: 18px; font-weight: 600; margin-bottom: 5px;">
                                            {{ $name }}
                                        </h5>
                                        <p style="color: #999999; font-size: 14px; margin: 0;">
                                            {{ $company }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation -->
                    <div class="tptestiarrow">
                        <div class="tptestiarrow__prv">
                            <i class="fas fa-angle-left"></i>
                        </div>
                        <div class="tptestiarrow__nxt">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
