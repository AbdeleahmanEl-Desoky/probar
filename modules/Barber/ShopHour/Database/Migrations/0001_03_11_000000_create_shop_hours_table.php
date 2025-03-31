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
        Schema::create('shop_hours', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('shop_id')->index();
            $table->tinyInteger('status')->default(1);
            $table->string('day');
            $table->time('opening_time');
            $table->time('closing_time');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_hours');
    }
};
