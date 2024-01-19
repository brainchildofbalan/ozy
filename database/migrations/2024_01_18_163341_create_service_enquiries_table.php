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
        Schema::create('service_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('follow_up')->nullable();
            $table->string('service');
            $table->string('category');
            $table->string('number');
            $table->string('email');
            $table->string('address');
            $table->text('other')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_enquiries');
    }
};