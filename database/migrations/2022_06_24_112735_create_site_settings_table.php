<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\SiteSetting;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('overall_comission')->default('10')->nullable();
            $table->string('paypal_mode')->nullable();
            $table->string('paypal_sandbox_api_secret')->nullable();
            $table->string('paypal_sandbox_api_username')->nullable();
            $table->string('paypal_sandbox_api_password')->nullable();
            $table->string('paypal_currency')->nullable();
            $table->timestamps();
        });

        SiteSetting::create([
            "overall_comission" => "10",
            "paypal_mode" => "sandbox",
            "paypal_sandbox_api_secret" => "AZ4dJ8px3GhIsO5MHrWJfwRvvo6bA4V0-CMQ.tFdjZqmKbegHHGKC2qi",
            "paypal_sandbox_api_username" => "sb-vdgjx16724852_api1.business.example.com",
            "paypal_sandbox_api_password" => "J2EDKGLL8GSV8QTC",
            "paypal_currency" => "USD",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
