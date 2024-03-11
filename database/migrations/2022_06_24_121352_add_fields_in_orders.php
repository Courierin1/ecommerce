<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('is_kit')->default(0)->after('status');
            $table->string('admin_profit')->nullable()->after('is_kit');
            $table->string('sponsor_comission')->nullable()->after('admin_profit');
            $table->text('note')->nullable()->after('admin_profit');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('is_kit');
            $table->dropColumn('admin_profit');
            $table->dropColumn('sponsor_comission');
            $table->dropColumn('note');
        });
    }
}
