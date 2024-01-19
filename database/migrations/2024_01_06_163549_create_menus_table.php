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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category_id');
            $table->string('url');
            $table->integer('order');
            $table->string('sub_categories');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
};