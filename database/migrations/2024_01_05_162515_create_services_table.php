<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->string('updated_by');
            $table->integer('order');
            $table->timestamps();
            $table->text('relative_products');
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
