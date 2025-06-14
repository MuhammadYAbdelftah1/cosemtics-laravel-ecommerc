<?php

use Botble\Setting\Models\Setting;
use Botble\Widget\Models\Widget;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    public function up(): void
    {
        // Update theme options copyright setting
        try {
            Setting::query()
                ->where('key', 'LIKE', '%copyright%')
                ->where('value', 'LIKE', '%Ninico%')
                ->update([
                    'value' => DB::raw("REPLACE(value, 'Ninico', 'Bs-Derma')")
                ]);

            Setting::query()
                ->where('key', 'LIKE', '%copyright%')
                ->where('value', 'LIKE', '%Botble%')
                ->update([
                    'value' => DB::raw("REPLACE(value, 'Botble', 'Ecom-Eg 🧠')")
                ]);

            // Update site title if it contains Ninico
            Setting::query()
                ->where('key', 'LIKE', '%site_title%')
                ->where('value', 'LIKE', '%Ninico%')
                ->update([
                    'value' => DB::raw("REPLACE(value, 'Ninico', 'Bs-Derma')")
                ]);

            // Update SEO description if it contains Ninico
            Setting::query()
                ->where('key', 'LIKE', '%seo_description%')
                ->where('value', 'LIKE', '%Ninico%')
                ->update([
                    'value' => DB::raw("REPLACE(value, 'Ninico', 'Bs-Derma')")
                ]);
        } catch (Throwable) {
            // Ignore errors if settings table doesn't exist or has different structure
        }

        // Update widget copyright data
        try {
            Widget::query()
                ->where('widget_id', 'SiteCopyrightWidget')
                ->get()
                ->each(function (Widget $widget) {
                    $data = $widget->data;
                    if (isset($data['description'])) {
                        $data['description'] = str_replace('Ninico', 'Bs-Derma', $data['description']);
                        $data['description'] = str_replace('Botble', 'Ecom-Eg 🧠', $data['description']);
                        $widget->data = $data;
                        $widget->save();
                    }
                });
        } catch (Throwable) {
            // Ignore errors if widgets table doesn't exist or has different structure
        }
    }

    public function down(): void
    {
        // Reverse the changes if needed
        try {
            Setting::query()
                ->where('key', 'LIKE', '%copyright%')
                ->where('value', 'LIKE', '%Bs-Derma%')
                ->update([
                    'value' => DB::raw("REPLACE(value, 'Bs-Derma', 'Ninico')")
                ]);

            Setting::query()
                ->where('key', 'LIKE', '%copyright%')
                ->where('value', 'LIKE', '%Ecom-Eg 🧠%')
                ->update([
                    'value' => DB::raw("REPLACE(value, 'Ecom-Eg 🧠', 'Botble')")
                ]);

            Setting::query()
                ->where('key', 'LIKE', '%site_title%')
                ->where('value', 'LIKE', '%Bs-Derma%')
                ->update([
                    'value' => DB::raw("REPLACE(value, 'Bs-Derma', 'Ninico')")
                ]);

            Setting::query()
                ->where('key', 'LIKE', '%seo_description%')
                ->where('value', 'LIKE', '%Bs-Derma%')
                ->update([
                    'value' => DB::raw("REPLACE(value, 'Bs-Derma', 'Ninico')")
                ]);
        } catch (Throwable) {
            // Ignore errors
        }

        try {
            Widget::query()
                ->where('widget_id', 'SiteCopyrightWidget')
                ->get()
                ->each(function (Widget $widget) {
                    $data = $widget->data;
                    if (isset($data['description'])) {
                        $data['description'] = str_replace('Bs-Derma', 'Ninico', $data['description']);
                        $data['description'] = str_replace('Ecom-Eg 🧠', 'Botble', $data['description']);
                        $widget->data = $data;
                        $widget->save();
                    }
                });
        } catch (Throwable) {
            // Ignore errors
        }
    }
};
