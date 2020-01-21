<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trans_id');
            $table->unsignedBigInteger('prod_id');
            $table->unsignedBigInteger('qty');
            $table->double('total', 8, 2)->default(0.00);
            $table->unsignedBigInteger('trans_status_id')->default(0);


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
        Schema::dropIfExists('sells_products');
    }
}
