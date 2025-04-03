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
        Schema::create('schedules', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->string('start_time')->index();
            $table->string('end_time')->index();
            $table->date('schedule_date')->index();
            $table->string('shop_id')->index();
            $table->string('client_id')->index()->nullable();
            $table->string('status')->default('pending');
            $table->string('note')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
