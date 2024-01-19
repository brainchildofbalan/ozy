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
        Schema::table('product_sub_categories', function (Blueprint $table) {
            $table->text('relative_category_id')->nullable(); // Replace 'relative_category_id' with your actual column name
        });
    }

    public function down()
    {
        Schema::table('product_sub_categories', function (Blueprint $table) {
            $table->dropColumn('relative_category_id');
        });
    }
};
