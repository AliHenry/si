<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id');
            $table->unsignedInteger('total_qty')->default(0);
            $table->unsignedTinyInteger('tax')->default(0);
            $table->double('sub_total', 8, 2)->default(0.00);
            $table->double('total', 8, 2)->default(0.00);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('trans_type_id');
            $table->unsignedBigInteger('trans_status_id');
            $table->unsignedBigInteger('cus_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('trans_type_id')->references('id')->on('payment_types')->onDelete('cascade');
            $table->foreign('trans_status_id')->references('id')->on('payment_status')->onDelete('cascade');
            $table->foreign('cus_id')->references('id')->on('customers')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sells');
    }
}
