<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Ecommerce\Models\Product;
use Botble\Ecommerce\Models\ProductCategory;
use Botble\Media\Facades\RvMedia;
use Botble\Slug\Facades\SlugHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RealProductSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->command->info('Starting Real Product Import...');

        // Create Beauty & Cosmetics category if it doesn't exist
        $beautyCategory = $this->createBeautyCategory();

        // Define product translations and data
        $products = $this->getProductData();

        foreach ($products as $productData) {
            $this->createProduct($productData, $beautyCategory);
        }

        $this->command->info('Real Product Import completed!');
    }

    private function createBeautyCategory(): ProductCategory
    {
        $category = ProductCategory::query()->where('name', 'Beauty & Cosmetics')->first();

        if (!$category) {
            $category = ProductCategory::query()->create([
                'name' => 'Beauty & Cosmetics',
                'description' => 'Premium beauty and cosmetic products for skincare and haircare',
                'status' => 'published',
                'is_featured' => true,
                'order' => 0,
            ]);

            SlugHelper::createSlug($category, 'Beauty & Cosmetics');
        }

        return $category;
    }

    private function getProductData(): array
    {
        return [
            [
                'arabic_filename' => 'body-oil-٢.png',
                'name' => 'Nourishing Body Oil',
                'description' => 'Luxurious body oil that deeply moisturizes and nourishes your skin, leaving it soft and radiant.',
                'content' => '<p>This premium body oil is formulated with natural ingredients to provide deep hydration and nourishment for your skin. Perfect for daily use, it absorbs quickly without leaving a greasy residue.</p><ul><li>Deep moisturizing formula</li><li>Natural ingredients</li><li>Quick absorption</li><li>Suitable for all skin types</li></ul>',
                'price' => 45.99,
                'sale_price' => 39.99,
                'sku' => 'BO-001',
            ],
            [
                'arabic_filename' => 'اى-لاش-scaled.png',
                'name' => 'Premium Eyelash Serum',
                'description' => 'Advanced eyelash growth serum that promotes longer, thicker, and stronger lashes naturally.',
                'content' => '<p>Transform your lashes with our scientifically formulated eyelash serum. This powerful treatment promotes natural lash growth while strengthening existing lashes.</p><ul><li>Promotes lash growth</li><li>Strengthens existing lashes</li><li>Clinically tested formula</li><li>Visible results in 4-6 weeks</li></ul>',
                'price' => 89.99,
                'sale_price' => 74.99,
                'sku' => 'EL-001',
            ],
            [
                'arabic_filename' => 'ديودرينت-1.png',
                'name' => 'Natural Deodorant',
                'description' => 'Aluminum-free natural deodorant that provides all-day protection with a fresh, clean scent.',
                'content' => '<p>Our natural deodorant is crafted with organic ingredients to provide effective protection without harsh chemicals. Free from aluminum, parabens, and synthetic fragrances.</p><ul><li>Aluminum-free formula</li><li>24-hour protection</li><li>Natural ingredients</li><li>Gentle on sensitive skin</li></ul>',
                'price' => 24.99,
                'sale_price' => 19.99,
                'sku' => 'DE-001',
            ],
            [
                'arabic_filename' => 'سيروم-سيكا-1.png',
                'name' => 'Cica Repair Serum',
                'description' => 'Soothing centella asiatica serum that calms irritated skin and promotes healing.',
                'content' => '<p>This gentle yet effective serum contains centella asiatica (cica) to soothe and repair damaged skin. Perfect for sensitive or acne-prone skin types.</p><ul><li>Contains centella asiatica</li><li>Soothes irritated skin</li><li>Promotes skin healing</li><li>Suitable for sensitive skin</li></ul>',
                'price' => 52.99,
                'sale_price' => 44.99,
                'sku' => 'CS-001',
            ],
            [
                'arabic_filename' => 'سيروم-شعر-1.png',
                'name' => 'Hair Growth Serum',
                'description' => 'Intensive hair serum that stimulates growth and strengthens hair follicles for thicker, healthier hair.',
                'content' => '<p>Our advanced hair growth serum is formulated with peptides and natural extracts to stimulate hair follicles and promote healthy hair growth. Suitable for all hair types.</p><ul><li>Stimulates hair growth</li><li>Strengthens hair follicles</li><li>Reduces hair loss</li><li>Suitable for all hair types</li></ul>',
                'price' => 67.99,
                'sale_price' => 57.99,
                'sku' => 'HS-001',
            ],
            [
                'arabic_filename' => 'سيروم-نياسينمايد-1.png',
                'name' => 'Niacinamide Brightening Serum',
                'description' => 'Powerful niacinamide serum that minimizes pores, controls oil, and brightens skin tone.',
                'content' => '<p>This concentrated niacinamide serum helps regulate oil production, minimize the appearance of pores, and even out skin tone for a brighter, clearer complexion.</p><ul><li>10% Niacinamide concentration</li><li>Minimizes pores</li><li>Controls oil production</li><li>Brightens skin tone</li></ul>',
                'price' => 38.99,
                'sale_price' => 32.99,
                'sku' => 'NS-001',
            ],
            [
                'arabic_filename' => 'شامبو-1.png',
                'name' => 'Moisturizing Shampoo',
                'description' => 'Gentle moisturizing shampoo that cleanses while nourishing dry and damaged hair.',
                'content' => '<p>Our sulfate-free moisturizing shampoo gently cleanses while providing deep hydration to dry and damaged hair. Enriched with natural oils and proteins.</p><ul><li>Sulfate-free formula</li><li>Deep moisturizing</li><li>Repairs damaged hair</li><li>Natural ingredients</li></ul>',
                'price' => 29.99,
                'sale_price' => 24.99,
                'sku' => 'SH-001',
            ],
            [
                'arabic_filename' => 'صن-اسكرين-1.png',
                'name' => 'Broad Spectrum Sunscreen SPF 50',
                'description' => 'High-protection sunscreen that shields skin from harmful UV rays while moisturizing.',
                'content' => '<p>Our broad-spectrum sunscreen provides superior protection against UVA and UVB rays with SPF 50. The lightweight, non-greasy formula is perfect for daily use.</p><ul><li>SPF 50 protection</li><li>Broad spectrum UVA/UVB</li><li>Water-resistant</li><li>Non-greasy formula</li></ul>',
                'price' => 34.99,
                'sale_price' => 29.99,
                'sku' => 'SS-001',
            ],
            [
                'arabic_filename' => 'غسول.png',
                'name' => 'Gentle Facial Cleanser',
                'description' => 'Mild facial cleanser that removes impurities while maintaining skin\'s natural moisture balance.',
                'content' => '<p>This gentle facial cleanser effectively removes dirt, oil, and makeup without stripping your skin of its natural oils. Perfect for daily use on all skin types.</p><ul><li>Gentle formula</li><li>Removes impurities</li><li>Maintains moisture balance</li><li>Suitable for all skin types</li></ul>',
                'price' => 26.99,
                'sale_price' => 22.99,
                'sku' => 'FC-001',
            ],
            [
                'arabic_filename' => 'فيتامين-سى-1.png',
                'name' => 'Vitamin C Brightening Serum',
                'description' => 'Potent vitamin C serum that brightens skin, reduces dark spots, and provides antioxidant protection.',
                'content' => '<p>Our stabilized vitamin C serum delivers powerful antioxidant protection while brightening your complexion and reducing the appearance of dark spots and hyperpigmentation.</p><ul><li>20% Vitamin C concentration</li><li>Brightens complexion</li><li>Reduces dark spots</li><li>Antioxidant protection</li></ul>',
                'price' => 58.99,
                'sale_price' => 49.99,
                'sku' => 'VC-001',
            ],
            [
                'arabic_filename' => 'كريم-ترطيب-1.png',
                'name' => 'Intensive Moisturizing Cream',
                'description' => 'Rich moisturizing cream that provides long-lasting hydration for dry and mature skin.',
                'content' => '<p>This luxurious moisturizing cream is formulated with hyaluronic acid and ceramides to provide intense hydration and restore your skin\'s natural barrier.</p><ul><li>Long-lasting hydration</li><li>Contains hyaluronic acid</li><li>Restores skin barrier</li><li>Perfect for dry skin</li></ul>',
                'price' => 42.99,
                'sale_price' => 36.99,
                'sku' => 'MC-001',
            ],
            [
                'arabic_filename' => 'كريم-تفتيح-1.png',
                'name' => 'Brightening Whitening Cream',
                'description' => 'Advanced brightening cream that evens skin tone and reduces hyperpigmentation.',
                'content' => '<p>This advanced brightening cream contains natural lightening agents that help even out skin tone and reduce the appearance of dark spots and hyperpigmentation.</p><ul><li>Evens skin tone</li><li>Reduces hyperpigmentation</li><li>Natural lightening agents</li><li>Gentle on skin</li></ul>',
                'price' => 48.99,
                'sale_price' => 41.99,
                'sku' => 'BC-001',
            ],
            [
                'arabic_filename' => 'كريم-شعر-1.png',
                'name' => 'Nourishing Hair Cream',
                'description' => 'Deep conditioning hair cream that repairs damage and adds shine to dull hair.',
                'content' => '<p>This nourishing hair cream penetrates deep into the hair shaft to repair damage, add moisture, and restore natural shine to dull, lifeless hair.</p><ul><li>Deep conditioning</li><li>Repairs damaged hair</li><li>Adds natural shine</li><li>Suitable for all hair types</li></ul>',
                'price' => 31.99,
                'sale_price' => 26.99,
                'sku' => 'HC-001',
            ],
            [
                'arabic_filename' => 'لوشن-الشعر-1.png',
                'name' => 'Hair Strengthening Lotion',
                'description' => 'Lightweight hair lotion that strengthens weak hair and prevents breakage.',
                'content' => '<p>This lightweight hair lotion is formulated with proteins and vitamins to strengthen weak hair, prevent breakage, and promote healthy hair growth.</p><ul><li>Strengthens weak hair</li><li>Prevents breakage</li><li>Promotes hair growth</li><li>Lightweight formula</li></ul>',
                'price' => 35.99,
                'sale_price' => 30.99,
                'sku' => 'HL-001',
            ],
            [
                'arabic_filename' => 'هير-ماسك-1.png',
                'name' => 'Intensive Hair Mask',
                'description' => 'Weekly intensive hair mask that deeply nourishes and repairs severely damaged hair.',
                'content' => '<p>This intensive hair mask provides deep nourishment and repair for severely damaged hair. Use weekly for best results to restore hair\'s health and vitality.</p><ul><li>Intensive repair treatment</li><li>Deep nourishment</li><li>Restores hair health</li><li>Weekly treatment</li></ul>',
                'price' => 39.99,
                'sale_price' => 33.99,
                'sku' => 'HM-001',
            ],
        ];
    }

    private function createProduct(array $productData, ProductCategory $category): void
    {
        $this->command->info("Creating product: {$productData['name']}");

        // Upload image first
        $imagePath = $this->uploadProductImage($productData['arabic_filename']);

        if (!$imagePath) {
            $this->command->warn("Failed to upload image for {$productData['name']}");
            return;
        }

        // Create the product
        $product = Product::query()->create([
            'name' => $productData['name'],
            'description' => $productData['description'],
            'content' => $productData['content'],
            'price' => $productData['price'],
            'sale_price' => $productData['sale_price'],
            'sku' => $productData['sku'],
            'image' => $imagePath,
            'images' => json_encode([$imagePath]),
            'status' => 'published',
            'is_featured' => true,
            'stock_status' => 'in_stock',
            'quantity' => rand(50, 200),
            'with_storehouse_management' => true,
            'weight' => rand(100, 500) / 100, // Random weight between 1-5
            'length' => rand(5, 15),
            'wide' => rand(5, 15),
            'height' => rand(10, 25),
        ]);

        // Associate with category
        $product->categories()->sync([$category->id]);

        // Create slug
        SlugHelper::createSlug($product, $productData['name']);

        $this->command->info("✓ Created product: {$productData['name']} (ID: {$product->id})");
    }

    private function uploadProductImage(string $filename): ?string
    {
        $sourcePath = base_path("products/{$filename}");

        if (!File::exists($sourcePath)) {
            $this->command->warn("Image file not found: {$sourcePath}");
            return null;
        }

        try {
            // Upload using RvMedia
            $result = RvMedia::uploadFromPath($sourcePath, 0, 'products');

            if ($result['error']) {
                $this->command->error("Upload failed: " . $result['message']);
                return null;
            }

            return $result['data']->url;
        } catch (\Exception $e) {
            $this->command->error("Exception during upload: " . $e->getMessage());
            return null;
        }
    }
}
