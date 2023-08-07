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
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('source');
            $table->unsignedBigInteger('marketplace_id')->nullable();
            $table->string('title');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->string('refrence')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
            $table->string('street');
            $table->string('postcode');
            $table->string('city');
            $table->integer('rigion');
            $table->integer('service_id')->nullable();
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
        Schema::dropIfExists('labels');
    }
};
