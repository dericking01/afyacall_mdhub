<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient_id');
            $table->string('user_id');
            $table->text('cheif_complaint')->nullable();
            $table->string('callers')->nullable();
            $table->text('dangersign')->nullable();
            $table->text('hist_pres_ill')->nullable();
            $table->text('prov_diagnos')->nullable();
            $table->text('surgeries')->nullable();
            $table->text('sugreries_reaction')->nullable();
            $table->date('lastdatemens')->nullable();
            $table->integer('number_pregnance')->nullable();
            $table->integer('number_live_birth')->nullable();
            $table->text('preg_complication')->nullable();
            $table->text('referral')->nullable();
            $table->text('counc_advice')->nullable();
            $table->text('other_plans')->nullable();
            $table->text('conclusion')->nullable();
            $table->text('medication_status')->nullable();
            $table->text('medication_name')->nullable();
            
            $table->text('dd')->nullable();
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
        Schema::dropIfExists('prescriptions');
    }
}
