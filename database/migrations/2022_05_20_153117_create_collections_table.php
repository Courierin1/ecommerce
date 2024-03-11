<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->bigIncrements('collection_id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string( 'name' );
            $table->text("description")->nullable();
            $table->string( 'slug' );
            $table->double( 'regular_price' )->default( 0.00 )->nullable();
            $table->double( 'sale_price' )->default( 0.00 )->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger( 'status' )->default( 0 );
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
        Schema::dropIfExists('collections');
    }
}
