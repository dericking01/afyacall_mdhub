<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIcdDiagnosisIdToPrescriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('icd_diagnosis_id')->nullable()->after('prov_diagnos');
            $table->foreign('icd_diagnosis_id')->references('id')->on('icd_diagnoses')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->dropForeign(['icd_diagnosis_id']);
            $table->dropColumn('icd_diagnosis_id');
        });
    }
}
