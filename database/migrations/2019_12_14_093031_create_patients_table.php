<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->integer('patient_id')->primary();
            $table->integer('doctor_id')->unsigned();
            $table->string('name', 256);
            $table->string('date_of_birth');
            $table->enum('sex', [1,2,3]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return voiddate_of_birth
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
