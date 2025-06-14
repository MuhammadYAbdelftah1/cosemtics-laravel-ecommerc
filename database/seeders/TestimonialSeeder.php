<?php

namespace Database\Seeders;

use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\Testimonial\Models\Testimonial;
use Illuminate\Support\Arr;

class TestimonialSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('testimonials');

        $testimonials = [
            [
                'name' => 'Sarah Ahmed',
                'company' => 'Skincare Enthusiast',
                'content' => 'Bs-Derma products have completely transformed my skincare routine. The quality is exceptional and the results are visible within weeks. Highly recommended! ⭐⭐⭐⭐⭐',
                'title' => 'Amazing transformation results',
            ],
            [
                'name' => 'Mona Hassan',
                'company' => 'Beauty Blogger',
                'content' => 'I have been using Bs-Derma for over a year now. The products are gentle yet effective, perfect for sensitive skin like mine. Amazing results! ⭐⭐⭐⭐⭐',
                'title' => 'Perfect for sensitive skin',
            ],
            [
                'name' => 'Fatima Ali',
                'company' => 'Dermatologist',
                'content' => 'As a dermatologist, I recommend Bs-Derma to my patients. The formulations are scientifically backed and deliver consistent results. Excellent quality! ⭐⭐⭐⭐⭐',
                'title' => 'Professional recommendation',
            ],
            [
                'name' => 'Nour Youssef',
                'company' => 'Makeup Artist',
                'content' => 'Bs-Derma products work perfectly as a base for makeup. They provide excellent hydration and create a smooth canvas. My clients love the results! ⭐⭐⭐⭐⭐',
                'title' => 'Perfect makeup base',
            ],
            [
                'name' => 'Yasmin Ibrahim',
                'company' => 'Beauty Influencer',
                'content' => 'I have tried countless skincare brands, but Bs-Derma stands out. The natural ingredients and effective formulas make it my top choice. Absolutely love it! ⭐⭐⭐⭐⭐',
                'title' => 'Top choice for skincare',
            ],
            [
                'name' => 'Dina Samir',
                'company' => 'Spa Owner',
                'content' => 'We use Bs-Derma products in our spa treatments. Our clients always ask about the products we use because of the amazing results they see. Highly effective! ⭐⭐⭐⭐⭐',
                'title' => 'Professional spa choice',
            ],
            [
                'name' => 'Mariam Adel',
                'company' => 'Pharmacist',
                'content' => 'The scientific approach behind Bs-Derma products is impressive. Safe, effective, and suitable for all skin types. I recommend them to my customers regularly. ⭐⭐⭐⭐⭐',
                'title' => 'Scientifically proven results',
            ],
        ];

        Testimonial::query()->truncate();

        foreach ($testimonials as $index => $item) {
            // Use random user images for testimonials
            $imageUrls = [
                'https://randomuser.me/api/portraits/women/1.jpg',
                'https://randomuser.me/api/portraits/women/2.jpg',
                'https://randomuser.me/api/portraits/women/3.jpg',
                'https://randomuser.me/api/portraits/women/4.jpg',
                'https://randomuser.me/api/portraits/women/5.jpg',
                'https://randomuser.me/api/portraits/women/6.jpg',
                'https://randomuser.me/api/portraits/women/7.jpg',
            ];

            $item['image'] = $imageUrls[$index] ?? $imageUrls[0];

            $testimonial = Testimonial::query()->create(Arr::except($item, ['title']));

            MetaBox::saveMetaBoxData($testimonial, 'title', Arr::get($item, 'title'));
            MetaBox::saveMetaBoxData($testimonial, 'star', 5);
        }
    }
}
