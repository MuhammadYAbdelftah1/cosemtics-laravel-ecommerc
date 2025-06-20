<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ec_customers', function (Blueprint $table) {
            $table->dropUnique('ec_customers_email_unique');
            $table->string('email')->nullable()->change();

        });
    }

    public function down(): void
    {
        Schema::table('ec_customers', function (Blueprint $table) {
            $table->string('email')->unique()->change();
        });
    }
};
