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
            $table->bigIncrements('product_id');
            $table->string( 'name' );
            $table->longText("short_description")->nullable();
            $table->longText("long_description")->nullable();
            $table->string( 'slug' )->nullable();
            $table->string( 'sku' )->nullable();
            $table->double( 'regular_price' )->default( 0.00 )->nullable();
            $table->double( 'sale_price' )->default( 0.00 )->nullable();
            // $table->tinyInteger( 'discount' )->default( 1 );
            $table->tinyInteger( 'in_stock' )->default( 1 );
            $table->tinyInteger( 'status' )->default( 1 );
            $table->string('image')->nullable();
            $table->json('gallery_images')->nullable();
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
