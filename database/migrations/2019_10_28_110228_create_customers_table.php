<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->string('code');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('lga_id');
            $table->unsignedBigInteger('pay_type_id');
            $table->string('image')->nullable();
            $table->text('remark')->nullable();
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('lga_id')->references('id')->on('lgas')->onDelete('cascade');
            $table->foreign('pay_type_id')->references('id')->on('payment_types')->onDelete('cascade');
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
        Schema::dropIfExists('customers');
    }
}
