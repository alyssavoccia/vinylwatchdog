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
        Schema::create('price_history', function (Blueprint $table) {
            $table->id(); // bigint, primary key
            $table->foreignId('vinyl_record_id')->constrained('vinyl_records')->onDelete('cascade');
            $table->enum('source', ['discogs', 'ebay', 'amazon']);
            $table->decimal('price', 8, 2);
            $table->string('currency', 3);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_history');
    }
};