<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cus_id');
            $table->unsignedBigInteger('tran_id')->nullable();
            $table->decimal('amount', 8, 2)->default(0.00);
            $table->decimal('arrears', 8, 2)->default(0.00);
            $table->decimal('new_amount', 8, 2)->default(0.00);
            $table->string('status')->default('loan');

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
        Schema::dropIfExists('loans');
    }
}
