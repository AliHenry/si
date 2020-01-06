<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreAuditsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_audits_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_audit_id');
            $table->unsignedBigInteger('prod_id');
            $table->boolean('balanced')->default(false);
            $table->unsignedInteger('missing')->default(0);
            $table->text('note')->default(null);
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
        Schema::dropIfExists('store_audits_products');
    }
}
