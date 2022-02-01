<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCdrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cdrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('callingDate')->nullable();
            $table->string('mssidn')->nullable();
            $table->string('service')->nullable();
            $table->string('lang')->nullable();
            $table->string('paymentMethod')->nullable();
            $table->string('selectedAudio')->nullable();
            $table->string('duration')->nullable();
            $table->string('paymentStatus')->nullable();
            $table->string('uniqueId')->nullable();
            $table->string('calledDr')->nullable();
            $table->string('newCustomer')->nullable();
            $table->string('serviceRating')->nullable();
            $table->string('hangupCause')->nullable();
            $table->string('callingStage')->nullable();
            $table->string('callOutCome')->nullable();
            $table->string('others')->nullable();
            $table->string('info')->nullable();
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
        Schema::dropIfExists('cdrs');
    }
}
