<?php

use Botble\Widget\Models\Widget;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up(): void
    {
        try {
            // Remove the "Information" widget (the empty one)
            Widget::query()
                ->where('widget_id', 'CustomMenuWidget')
                ->where('sidebar_id', 'footer_sidebar')
                ->whereJsonContains('data->name', 'Information')
                ->whereJsonContains('data->menu_id', 'information')
                ->delete();

            // Update "My Account" widget to "Information"
            Widget::query()
                ->where('widget_id', 'CustomMenuWidget')
                ->where('sidebar_id', 'footer_sidebar')
                ->whereJsonContains('data->name', 'My Account')
                ->whereJsonContains('data->menu_id', 'my-account')
                ->get()
                ->each(function (Widget $widget) {
                    $data = $widget->data;
                    $data['name'] = 'Information';
                    // Keep the same menu_id (my-account) as it contains the actual menu items
                    $widget->data = $data;
                    $widget->position = 1; // Update position since we removed the first widget
                    $widget->save();
                });

            // Update positions for remaining widgets in footer_sidebar
            // Social Network widget should be position 2
            Widget::query()
                ->where('widget_id', 'CustomMenuWidget')
                ->where('sidebar_id', 'footer_sidebar')
                ->whereJsonContains('data->name', 'Social Network')
                ->update(['position' => 2]);

            // Newsletter widget should be position 3
            Widget::query()
                ->where('widget_id', 'NewsletterWidget')
                ->where('sidebar_id', 'footer_sidebar')
                ->update(['position' => 3]);

        } catch (Throwable) {
            // Ignore errors if widgets table doesn't exist or has different structure
        }
    }

    public function down(): void
    {
        try {
            // Reverse the changes
            // First, update positions back
            Widget::query()
                ->where('widget_id', 'NewsletterWidget')
                ->where('sidebar_id', 'footer_sidebar')
                ->update(['position' => 4]);

            Widget::query()
                ->where('widget_id', 'CustomMenuWidget')
                ->where('sidebar_id', 'footer_sidebar')
                ->whereJsonContains('data->name', 'Social Network')
                ->update(['position' => 3]);

            // Change "Information" back to "My Account"
            Widget::query()
                ->where('widget_id', 'CustomMenuWidget')
                ->where('sidebar_id', 'footer_sidebar')
                ->whereJsonContains('data->name', 'Information')
                ->whereJsonContains('data->menu_id', 'my-account')
                ->get()
                ->each(function (Widget $widget) {
                    $data = $widget->data;
                    $data['name'] = 'My Account';
                    $widget->data = $data;
                    $widget->position = 2; // Restore original position
                    $widget->save();
                });

            // Recreate the "Information" widget (the empty one)
            Widget::query()->create([
                'widget_id' => 'CustomMenuWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 1,
                'data' => [
                    'name' => 'Information',
                    'menu_id' => 'information',
                ],
                'theme' => Widget::getThemeName(),
            ]);

        } catch (Throwable) {
            // Ignore errors
        }
    }
};
