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
        Schema::create('shop_hour_details', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('shop_hour_id')->index();
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
            $table->tinyInteger('status')->default(1);

            $table->foreign('shop_hour_id')->references('id')->on('shop_hours')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_hour_details');
    }
};
