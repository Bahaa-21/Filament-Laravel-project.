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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('brand_id')
                ->constrained('brands')
                ->cascadeOnDelete();

            $table->string('sku')->unique();

            $table->string('slug')->unique();

            $table->unsignedBigInteger('quantity');

            $table->string('image');

            $table->boolean('is_visible')->default(false);

            $table->boolean('is_featured')->default(false);

            $table->date('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            Schema::dropColumns('products', [
                'brand_id',
                'sku',
                'slug',
                'quantity',
                'is_visible',
                'is_featured',
                'published_at',
            ]);
        });
    }
};
