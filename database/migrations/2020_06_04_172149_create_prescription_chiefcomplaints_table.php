<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionChiefcomplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_chiefcomplaints', function (Blueprint $table) {
            $table->integer('prescription_id')->unsigned();
            $table->integer('chief_complaint_id')->unsigned();
            $table->foreign('prescription_id')->references('id')->on('prescriptions')
                  ->onDelete('cascade');
            $table->foreign('chief_complaint_id')->references('id')->on('chief_complaints')
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
        Schema::dropIfExists('prescription_chiefcomplaints');
    }
}
