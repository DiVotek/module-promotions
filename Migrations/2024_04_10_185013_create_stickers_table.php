<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Promotions\Models\Sticker;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Sticker::getDb(), function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->string('name');
            $table->string('color')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default(1);
            Sticker::timestampFields($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Sticker::getDb());
    }
};
