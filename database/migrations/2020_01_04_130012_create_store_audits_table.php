<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cate_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('balanced')->default(0);
            $table->unsignedBigInteger('unbalanced')->default(0);
            $table->text('note')->default(null);
            $table->foreign('cate_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('store_audits');
    }
}
