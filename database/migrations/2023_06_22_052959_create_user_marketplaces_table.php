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
        Schema::create('user_marketplaces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marketplace_id');
            $table->unsignedBigInteger('store_id');

            $table->foreign('marketplace_id')->references('id')->on('marketplaces')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
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
        Schema::dropIfExists('user_marketplaces');
    }
};
