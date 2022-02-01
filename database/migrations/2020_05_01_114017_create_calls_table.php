<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('call_id')->nullable();
            $table->string('caller_number')->nullable();
            $table->datetime('call_date')->nullable();
            $table->string('call_duration')->nullable();
            $table->string('call_talktime')->nullable();
            $table->string('status')->nullable();
            $table->string('channel')->nullable();
            $table->string('call_disconnection')->nullable();
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
        Schema::dropIfExists('calls');
    }
}
