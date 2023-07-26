<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->dateTime('credit_added');
            $table->double('credit_amount');
            $table->double('total');
            $table->unsignedBigInteger('source_id')->references('id')->on('sources')->onDelete('cascade');;
            $table->string('details');
            $table->unsignedBigInteger('addto');
            $table->unsignedBigInteger('addby');
            $table->foreign('addto')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('addby')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('credits');
    }
};
