<?php
// database/migrations/YYYY_MM_DD_create_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('city');
            $table->string('countryCode');
            $table->string('email');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('phone');
            $table->string('postalCode');
            $table->string('time');
            $table->string('zone');
            $table->string('status');
            $table->string('products');
            $table->string('description')->nullable();
            $table->string('notes')->nullable();
            $table->string('other')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
