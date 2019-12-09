<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->unsignedBigInteger('cus_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->float('arrears', '10', '2')->default(0.00);
            $table->float('current_amount', '10', '2')->default(0.00);
            $table->float('paid_amount', '10', '2')->default(0.00);
            $table->date('payment_date');
            $table->foreign('cus_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('billing');
    }
}
