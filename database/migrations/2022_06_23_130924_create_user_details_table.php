<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('dob')->nullable();
            $table->string('ssn')->nullable();
            $table->string('language')->nullable();
            $table->string('bill_street_1')->nullable();
            $table->string('bill_street_2')->nullable();
            $table->string('bill_postal_code')->nullable();
            $table->string('bill_city')->nullable();
            $table->string('bill_state')->nullable();
            $table->string('bill_county')->nullable();
            $table->string('bill_country')->nullable();
            $table->string('ship_street_1')->nullable();
            $table->string('ship_street_2')->nullable();
            $table->string('ship_postal_code')->nullable();
            $table->string('ship_city')->nullable();
            $table->string('ship_state')->nullable();
            $table->string('ship_county')->nullable();
            $table->string('ship_country')->nullable();
            $table->string('hphone')->nullable();
            $table->string('cphone')->nullable();
            $table->string('wphone')->nullable();
            $table->string('fax')->nullable();
            $table->enum('payment_method',['DIRECT','CHECK'])->default('DIRECT');
            $table->string('bank')->nullable();
            $table->string('routing')->nullable();
            $table->string('acc_no')->nullable();
            $table->string('acc_type')->nullable();
            $table->boolean('terms')->default(0);
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
        Schema::dropIfExists('user_details');
    }
}
