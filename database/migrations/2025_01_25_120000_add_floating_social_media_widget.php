<?php

use Botble\Theme\Facades\Theme;
use Botble\Widget\Models\Widget;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up(): void
    {
        // Add floating social media widget with sample data
        Widget::query()->create([
            'widget_id' => 'FloatingSocialMediaWidget',
            'sidebar_id' => 'floating_social_sidebar',
            'position' => 0,
            'data' => [
                'enabled' => true,
                'help_text' => 'للمساعدة',
                'whatsapp_enabled' => true,
                'whatsapp_number' => '+201019831970',
                'facebook_enabled' => true,
                'facebook_url' => 'https://facebook.com/bsderma',
                'instagram_enabled' => true,
                'instagram_url' => 'https://instagram.com/bsderma',
            ],
            'theme' => Theme::getThemeName(),
        ]);
    }

    public function down(): void
    {
        Widget::query()
            ->where('widget_id', 'FloatingSocialMediaWidget')
            ->where('sidebar_id', 'floating_social_sidebar')
            ->delete();
    }
};
