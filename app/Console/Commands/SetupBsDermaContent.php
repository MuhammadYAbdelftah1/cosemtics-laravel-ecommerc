<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Botble\Blog\Models\Post;
use Botble\Blog\Models\Category;
use Botble\Faq\Models\Faq;
use Botble\Faq\Models\FaqCategory;
use Botble\ACL\Models\User;
use Botble\Media\Models\MediaFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SetupBsDermaContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:bs-derma-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup BS Derma blog posts and FAQs content';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting BS Derma content setup...');

        // Get the first admin user
        $admin = User::first();
        if (!$admin) {
            $this->error('No admin user found!');
            return 1;
        }

        // Delete all existing blog posts
        $this->info('Deleting existing blog posts...');
        DB::table('post_categories')->delete();
        DB::table('post_tags')->delete();
        Post::query()->delete();

        // Delete all existing FAQs
        $this->info('Deleting existing FAQs...');
        Faq::query()->delete();

        // Create or get blog category
        $blogCategory = Category::firstOrCreate([
            'name' => 'Skincare Tips',
            'description' => 'Professional skincare advice and tips',
            'status' => 'published',
            'is_featured' => 1,
            'author_id' => $admin->id,
            'author_type' => User::class,
        ]);

        // Create or get FAQ category
        $faqCategory = FaqCategory::firstOrCreate([
            'name' => 'BS Derma Products',
            'status' => 'published',
            'order' => 1,
        ]);

        // Image files to use
        $imageFiles = [
            '1s.jpg',
            '1stss.jpg',
            '2nds.jpg',
            '2s.jpg',
            '3rdss.jpg',
            'egy.jpg',
            'cs.jpg',
            'hc.jpg'
        ];

        // Copy images to storage and create media records
        $mediaFiles = [];
        foreach ($imageFiles as $imageFile) {
            $sourcePath = "/Applications/MAMP/htdocs/bsder/{$imageFile}";
            if (file_exists($sourcePath)) {
                $destinationPath = "blog/" . $imageFile;
                $fullDestinationPath = storage_path("app/public/{$destinationPath}");

                // Create directory if it doesn't exist
                $dir = dirname($fullDestinationPath);
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }

                // Copy file
                copy($sourcePath, $fullDestinationPath);

                // Create media record
                $mediaFile = MediaFile::create([
                    'user_id' => $admin->id,
                    'name' => pathinfo($imageFile, PATHINFO_FILENAME),
                    'folder_id' => 0,
                    'mime_type' => 'image/jpeg',
                    'size' => filesize($sourcePath),
                    'url' => "blog/{$imageFile}",
                    'options' => json_encode([]),
                ]);

                $mediaFiles[] = $mediaFile;
                $this->info("Copied and registered: {$imageFile}");
            }
        }

        $this->setupBlogPosts($admin, $blogCategory, $mediaFiles);
        $this->setupFaqs($faqCategory);

        $this->info("\n=== Setup completed successfully! ===");
        $this->info("✅ Deleted all existing blog posts and FAQs");
        $this->info("✅ Created 5 new blog posts about BS Derma products");
        $this->info("✅ Created 5 new FAQs about BS Derma products");
        $this->info("✅ Copied and registered " . count($mediaFiles) . " images");
        $this->info("✅ All content is now focused on BS Derma skincare products");
        $this->info("\nYou can now visit:");
        $this->info("- Blog posts: http://localhost:8888/admin/blog/posts");
        $this->info("- FAQs: http://localhost:8888/admin/faqs");
        $this->info("- Frontend blog: http://localhost:8888/blog");

        return 0;
    }

    private function setupBlogPosts($admin, $blogCategory, $mediaFiles)
    {
        // BS Derma blog posts data
        $blogPosts = [
            [
                'name' => 'The Ultimate Guide to Vitamin C Serums for Glowing Skin',
                'description' => 'Discover how BS Derma\'s Vitamin C serum can transform your skincare routine and give you radiant, healthy-looking skin.',
                'content' => '<p>Vitamin C is one of the most powerful antioxidants in skincare, and BS Derma\'s advanced Vitamin C serum delivers exceptional results for all skin types.</p>

<h3>Why Choose BS Derma Vitamin C Serum?</h3>
<p>Our scientifically formulated serum contains:</p>
<ul>
<li>20% L-Ascorbic Acid for maximum potency</li>
<li>Hyaluronic acid for deep hydration</li>
<li>Vitamin E for enhanced antioxidant protection</li>
<li>Ferulic acid to stabilize the formula</li>
</ul>

<h3>How to Use</h3>
<p>Apply 2-3 drops to clean skin every morning, followed by sunscreen. Start with every other day if you have sensitive skin.</p>

<h3>Expected Results</h3>
<p>Within 4-6 weeks of consistent use, you can expect:</p>
<ul>
<li>Brighter, more even skin tone</li>
<li>Reduced appearance of dark spots</li>
<li>Improved skin texture and firmness</li>
<li>Enhanced natural glow</li>
</ul>

<p>Transform your skin with BS Derma\'s professional-grade Vitamin C serum today!</p>',
            ],
            [
                'name' => 'Niacinamide: The Multi-Tasking Skincare Hero',
                'description' => 'Learn about the incredible benefits of niacinamide and how BS Derma\'s niacinamide serum can address multiple skin concerns.',
                'content' => '<p>Niacinamide, also known as Vitamin B3, is a versatile skincare ingredient that addresses multiple skin concerns simultaneously. BS Derma\'s 10% Niacinamide Serum is formulated to deliver maximum benefits.</p>

<h3>Key Benefits of BS Derma Niacinamide Serum</h3>
<ul>
<li><strong>Pore Minimization:</strong> Reduces the appearance of enlarged pores</li>
<li><strong>Oil Control:</strong> Regulates sebum production for balanced skin</li>
<li><strong>Brightening:</strong> Evens skin tone and reduces hyperpigmentation</li>
<li><strong>Anti-Aging:</strong> Stimulates collagen production</li>
<li><strong>Barrier Repair:</strong> Strengthens the skin\'s natural protective barrier</li>
</ul>

<h3>Perfect for All Skin Types</h3>
<p>Whether you have oily, dry, sensitive, or combination skin, niacinamide is gentle yet effective. Our formula is:</p>
<ul>
<li>Non-comedogenic</li>
<li>Fragrance-free</li>
<li>Suitable for sensitive skin</li>
<li>Can be used morning and evening</li>
</ul>

<p>Experience the transformative power of niacinamide with BS Derma\'s expertly crafted serum.</p>',
            ],
            [
                'name' => 'Complete Hair Care Routine with BS Derma Products',
                'description' => 'Discover the perfect hair care routine using BS Derma\'s professional hair treatment products for healthy, beautiful hair.',
                'content' => '<p>Achieving healthy, lustrous hair requires the right products and routine. BS Derma\'s comprehensive hair care line provides everything you need for salon-quality results at home.</p>

<h3>BS Derma Hair Care Essentials</h3>
<h4>1. Clarifying Shampoo</h4>
<p>Our sulfate-free shampoo gently cleanses while preserving natural oils:</p>
<ul>
<li>Removes buildup without stripping</li>
<li>Suitable for all hair types</li>
<li>Enriched with natural botanicals</li>
</ul>

<h4>2. Intensive Hair Mask</h4>
<p>Deep conditioning treatment for damaged or dry hair:</p>
<ul>
<li>Repairs and strengthens hair fibers</li>
<li>Provides intense moisture</li>
<li>Reduces breakage and split ends</li>
</ul>

<h4>3. Hair Growth Serum</h4>
<p>Stimulates healthy hair growth with clinically proven ingredients:</p>
<ul>
<li>Peptides to strengthen follicles</li>
<li>Biotin for hair health</li>
<li>Natural extracts to nourish scalp</li>
</ul>

<h3>Weekly Hair Care Routine</h3>
<p><strong>2-3 times per week:</strong> Use clarifying shampoo<br>
<strong>Once per week:</strong> Apply intensive hair mask<br>
<strong>Daily:</strong> Apply hair growth serum to scalp</p>

<p>Transform your hair with BS Derma\'s professional-grade hair care system!</p>',
            ],
            [
                'name' => 'Sun Protection: Your Daily Defense Against Aging',
                'description' => 'Learn why BS Derma\'s broad-spectrum sunscreen is essential for preventing premature aging and maintaining healthy skin.',
                'content' => '<p>Sun protection is the most important step in any anti-aging skincare routine. BS Derma\'s advanced sunscreen formulas provide superior protection while feeling lightweight and comfortable.</p>

<h3>Why BS Derma Sunscreen is Different</h3>
<ul>
<li><strong>Broad-Spectrum Protection:</strong> Shields against both UVA and UVB rays</li>
<li><strong>SPF 50+:</strong> Maximum protection for daily use</li>
<li><strong>Non-Greasy Formula:</strong> Absorbs quickly without white residue</li>
<li><strong>Antioxidant Boost:</strong> Contains vitamin E and green tea extract</li>
<li><strong>Water-Resistant:</strong> Perfect for active lifestyles</li>
</ul>

<h3>The Science of Sun Damage</h3>
<p>UV radiation causes:</p>
<ul>
<li>Premature aging (photoaging)</li>
<li>Dark spots and hyperpigmentation</li>
<li>Loss of collagen and elasticity</li>
<li>Increased risk of skin cancer</li>
</ul>

<h3>Application Tips</h3>
<p>For optimal protection:</p>
<ul>
<li>Apply 15-20 minutes before sun exposure</li>
<li>Use approximately 1/4 teaspoon for face and neck</li>
<li>Reapply every 2 hours or after swimming/sweating</li>
<li>Don\'t forget often-missed areas like ears and lips</li>
</ul>

<p>Make BS Derma sunscreen your daily defense against aging and skin damage!</p>',
            ],
            [
                'name' => 'The Complete Guide to Body Care with BS Derma',
                'description' => 'Extend your skincare routine beyond your face with BS Derma\'s luxurious body care products for smooth, hydrated skin.',
                'content' => '<p>Your body deserves the same level of care as your face. BS Derma\'s body care collection provides professional-grade ingredients in luxurious formulations for total skin wellness.</p>

<h3>BS Derma Body Care Essentials</h3>

<h4>Exfoliating Body Wash</h4>
<p>Gentle yet effective cleansing with natural exfoliants:</p>
<ul>
<li>Removes dead skin cells</li>
<li>Improves skin texture</li>
<li>Prepares skin for moisturizer absorption</li>
<li>Infused with nourishing oils</li>
</ul>

<h4>Hydrating Body Oil</h4>
<p>Lightweight oil that absorbs quickly:</p>
<ul>
<li>Jojoba and argan oil blend</li>
<li>Provides long-lasting moisture</li>
<li>Suitable for all skin types</li>
<li>Leaves skin silky smooth</li>
</ul>

<h4>Intensive Body Cream</h4>
<p>Rich, nourishing cream for very dry skin:</p>
<ul>
<li>Ceramides to restore barrier function</li>
<li>Hyaluronic acid for deep hydration</li>
<li>Shea butter for softness</li>
<li>Non-greasy, fast-absorbing formula</li>
</ul>

<h3>Daily Body Care Routine</h3>
<p><strong>Morning:</strong> Cleanse with exfoliating wash, apply body oil<br>
<strong>Evening:</strong> Apply intensive body cream to damp skin<br>
<strong>Weekly:</strong> Use body scrub for deeper exfoliation</p>

<p>Pamper your skin from head to toe with BS Derma\'s complete body care system!</p>',
            ],
        ];

        $this->info('Creating blog posts...');
        foreach ($blogPosts as $index => $postData) {
            // Assign specific images to each post
            $imageUrl = null;
            if (isset($mediaFiles[$index]) && $mediaFiles[$index]) {
                $imageUrl = $mediaFiles[$index]->url;
            }

            $post = Post::create([
                'name' => $postData['name'],
                'description' => $postData['description'],
                'content' => $postData['content'],
                'status' => 'published',
                'author_id' => $admin->id,
                'author_type' => User::class,
                'is_featured' => $index < 2 ? 1 : 0,
                'image' => $imageUrl,
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(1, 30)),
            ]);

            // Attach to category
            $post->categories()->attach($blogCategory->id);

            $imageInfo = $imageUrl ? " with image: " . basename($imageUrl) : " (no image)";
            $this->info("Created blog post: {$postData['name']}{$imageInfo}");
        }
    }

    private function setupFaqs($faqCategory)
    {
        // BS Derma FAQs data
        $faqs = [
            [
                'question' => 'What makes BS Derma products different from other skincare brands?',
                'answer' => 'BS Derma products are formulated with clinically proven ingredients at optimal concentrations. Our products undergo rigorous testing and are developed by dermatologists to ensure safety and efficacy. We use advanced delivery systems to maximize ingredient penetration and results. Additionally, all our products are cruelty-free, paraben-free, and suitable for sensitive skin.',
            ],
            [
                'question' => 'How long does it take to see results with BS Derma products?',
                'answer' => 'Results vary depending on the product and individual skin type. Generally, you may notice initial improvements in skin texture and hydration within 1-2 weeks. For anti-aging benefits and significant improvements in skin tone, most users see noticeable results within 4-6 weeks of consistent use. For best results, we recommend using products consistently for at least 8-12 weeks.',
            ],
            [
                'question' => 'Can I use multiple BS Derma serums together?',
                'answer' => 'Yes, many BS Derma serums can be layered together. We recommend applying products from thinnest to thickest consistency. Start with water-based serums like Niacinamide, followed by oil-based serums like Vitamin C. Always allow each product to absorb for 2-3 minutes before applying the next. If you\'re new to active ingredients, introduce one product at a time to assess tolerance.',
            ],
            [
                'question' => 'Are BS Derma products suitable for sensitive skin?',
                'answer' => 'Yes, BS Derma products are formulated to be gentle yet effective, making them suitable for sensitive skin. Our products are fragrance-free, hypoallergenic, and dermatologist-tested. However, we always recommend performing a patch test before using any new product. Start with lower concentrations and gradually increase usage frequency as your skin builds tolerance.',
            ],
            [
                'question' => 'What is the correct order to apply BS Derma skincare products?',
                'answer' => 'The general rule is to apply products from thinnest to thickest consistency: 1) Cleanser, 2) Toner/Essence, 3) Serums (Vitamin C in AM, Retinol in PM), 4) Eye cream, 5) Moisturizer, 6) Sunscreen (AM only). Allow 2-3 minutes between each step for proper absorption. For evening routine, remove sunscreen with oil cleanser first, then follow with regular cleanser.',
            ],
        ];

        // Create FAQs
        $this->info('Creating FAQs...');
        foreach ($faqs as $faqData) {
            Faq::create([
                'question' => $faqData['question'],
                'answer' => $faqData['answer'],
                'category_id' => $faqCategory->id,
                'status' => 'published',
                'created_at' => now()->subDays(rand(1, 15)),
                'updated_at' => now()->subDays(rand(1, 15)),
            ]);

            $this->info("Created FAQ: {$faqData['question']}");
        }
    }
}
