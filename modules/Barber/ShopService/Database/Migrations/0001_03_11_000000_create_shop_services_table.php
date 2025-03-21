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
        Schema::create('shop_services', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('shop_id')->index();
            $table->string('price');
            $table->integer('time');
            $table->timestamps();

            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_services');
    }
};
