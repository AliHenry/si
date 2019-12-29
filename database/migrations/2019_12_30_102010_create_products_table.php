<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('qty')->default(0);
            $table->double('price', 8, 2)->default(0.00);
            $table->double('discount_price', 8, 2)->default(0.00);
            $table->string('measure')->nullable();
            $table->unsignedBigInteger('cate_id');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedTinyInteger('limit');
            $table->boolean('featured')->default(true);
            $table->string('image')->nullable();
            $table->foreign('cate_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

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
        Schema::dropIfExists('products');
    }
}
