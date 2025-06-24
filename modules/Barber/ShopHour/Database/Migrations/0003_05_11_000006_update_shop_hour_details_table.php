<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('shop_hour_details', function (Blueprint $table) {
            // We add the 'day' column, e.g., 'Sunday', 'Monday', etc.
            // It's indexable for faster queries.
            $table->uuid('shop_id')->after('shop_hour_id')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shop_hour_details', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });
    }
};
