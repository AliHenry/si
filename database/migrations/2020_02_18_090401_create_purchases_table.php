<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_name')->nullable();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('prod_id');
            $table->unsignedBigInteger('supplied_qty')->default(0);
            $table->double('supplied_price', 8, 2)->default(0.00);
            $table->double('total_price', 8, 2)->default(0.00);
            $table->double('discount', 8, 2)->default(0.00);
            $table->unsignedBigInteger('current_qty')->default(0);
            $table->unsignedBigInteger('receiver_id');

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('prod_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('purchases');
    }
}
