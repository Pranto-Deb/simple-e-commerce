<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('br_id');
            $table->longText('product_details');
            $table->longText('product_features');
            $table->string('product_price');
            $table->string('product_quantity');
            $table->longText('product_meta');
            $table->unsignedTinyInteger('position');
            $table->boolean('status')->nullable()->default(config('app.active'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
