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
            $table->string('discogs_id')->nullable()->index();
            $table->string('ebay_id')->nullable()->index();
            $table->string('amazon_id')->nullable()->index();
            $table->string('title')->index();
            $table->string('artist')->index();
            $table->string('genre')->nullable();
            $table->string('pressing')->nullable();
            $table->string('year')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('discogs_link')->nullable();
            $table->string('ebay_link')->nullable();
            $table->string('amazon_link')->nullable();
            $table->decimal('lowest_price', 8, 2)->nullable()->index();
            $table->string('lowest_price_currency', 3);
            $table->json('tracklist')->nullable();
            $table->timestamps();

            $table->index(['title', 'artist']); // Composite index
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