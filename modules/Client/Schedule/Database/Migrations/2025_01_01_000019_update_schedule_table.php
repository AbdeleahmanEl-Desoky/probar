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
        Schema::table('schedules', function (Blueprint $table) {
            $table->decimal('addition', 10, 2)->nullable()->after('payment');
            $table->decimal('discount', 10, 2)->nullable()->after('addition');
        });
    }
    public function down(): void
    {
        Schema::table('schedule_shops', function (Blueprint $table) {
            $table->dropColumn(['addition', 'discount']);
        });
    }
};
