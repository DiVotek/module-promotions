<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Promotions\Models\Promotion;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Promotion::getDb(), function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->string('name');
            $table->json('value')->nullable();
            $table->integer('sticker_id')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('status')->default(1);
            Promotion::timestampFields($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Promotion::getDb());
    }
};
