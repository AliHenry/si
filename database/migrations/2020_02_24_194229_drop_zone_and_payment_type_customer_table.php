<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropZoneAndPaymentTypeCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign('customers_zone_id_foreign');
            $table->dropForeign('customers_pay_type_id_foreign');
            $table->dropColumn(['zone_id', 'pay_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->unsignedBigInteger('pay_type_id');

            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->foreign('pay_type_id')->references('id')->on('payment_types')->onDelete('cascade');

        });
    }
}
