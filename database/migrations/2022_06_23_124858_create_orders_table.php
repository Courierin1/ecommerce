<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id');
            $table->integer('user_id');
            $table->string('bill_street_1');
            $table->string('bill_street_2');
            $table->string('bill_postal_code');
            $table->string('bill_city');
            $table->string('bill_state');
            $table->string('bill_county');
            $table->string('bill_country');
            $table->string('ship_street_1');
            $table->string('ship_street_2');
            $table->string('ship_postal_code');
            $table->string('ship_city');
            $table->string('ship_state');
            $table->string('ship_county');
            $table->string('ship_country');
            $table->float('grand_total',10,2);
            $table->boolean('payment_status')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
