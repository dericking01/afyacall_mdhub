<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionSymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_symptoms', function (Blueprint $table) {
            $table->integer('prescription_id')->unsigned();
            $table->integer('symptom_id')->unsigned();
            $table->foreign('prescription_id')->references('id')->on('prescriptions')
                  ->onDelete('cascade');
            $table->foreign('symptom_id')->references('id')->on('symptoms')
                 ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescription_symptoms');
    }
}
