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
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('keywords');
            $table->string('author')->nullable();
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('type')->nullable(); // e.g., article, website, product
            $table->string('locale')->nullable(); // e.g., en_US, fr_FR
            $table->string('site_name')->nullable(); // Your website name
            $table->string('twitter_site')->nullable(); // Twitter username for site
            $table->string('twitter_creator')->nullable(); // Twitter username for author
            $table->string('og_type')->nullable(); // Open Graph type
            $table->string('og_title')->nullable(); // Open Graph title
            $table->text('og_description')->nullable(); // Open Graph description
            $table->string('og_image')->nullable(); // Open Graph image
            $table->string('og_url')->nullable(); // Open Graph URL
            $table->string('og_locale')->nullable(); // Open Graph locale
            $table->string('og_site_name')->nullable(); // Open Graph site name
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
