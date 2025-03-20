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
        Schema::create('shops', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->string('barber_id')->index();
            // $table->string('name');
            // $table->text('description');
            $table->integer('worker_no')->default(1);
            $table->string('city_id')->index();
            $table->string('street')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->timestamps();

            $table->foreign('barber_id')->references('id')->on('barbers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
