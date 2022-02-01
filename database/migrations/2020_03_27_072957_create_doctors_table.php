<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('phone');
            $table->string('nationId')->nullable();
            $table->string('medicalSchool')->nullable();
            $table->string('health_facility')->nullable();
            $table->string('health_facility_type')->nullable();
            $table->string('section')->nullable();
            $table->string('currentemployer_otherinfo')->nullable();
            $table->string('medicalRegisterNumber')->nullable();
            $table->string('box')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('other_email')->nullable();
            $table->string('effective_communication')->nullable();
            $table->string('customer_care')->nullable();
            $table->string('medical_ethics')->nullable();
            $table->string('telehealth')->nullable();
            $table->integer('user_id');
            $table->integer('region_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->string('avatar')->default('user.jpg');
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
        Schema::dropIfExists('doctors');
    }
}
