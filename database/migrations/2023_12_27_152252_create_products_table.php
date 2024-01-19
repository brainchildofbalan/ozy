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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->text('specifications');
            $table->text('category_id');
            $table->text('sub_category_id');
            $table->decimal('price', 8, 2);
            $table->decimal('quantity_in_stock', 8, 2);
            $table->json('images');
            $table->json('related_products');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_valuable')->default(false);
            $table->timestamps();
            $table->string('product_code')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};