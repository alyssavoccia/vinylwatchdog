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
        Schema::create('vinyl_records', function (Blueprint $table) {
            $table->id();
            $table->string('discogs_id')->nullable();
            $table->string('ebay_id')->nullable();
            $table->string('amazon_id')->nullable();
            $table->string('title');
            $table->string('artist');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vinyl_records');
    }
};