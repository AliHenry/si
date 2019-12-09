<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attend_id');
            $table->foreign('attend_id')->references('id')->on('attendance')->onDelete('cascade');

            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade');

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
        Schema::dropIfExists('attendance_employees');
    }
}
