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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('request_file_name_user');
            $table->string('request_file_name_generated');
            $table->integer('no_of_items');
            $table->decimal('total_credits');
            $table->integer('number_of_polls');
            $table->tinyInteger('response_downloaded');
            $table->string('responsefilename');
            $table->dateTime('datecreated');
            $table->dateTime('lastmodified');
            $table->integer('batchuploadrequestcontentid');
            $table->integer('batchuploadstatusid');
            $table->string('responsefilenamepdflabels');
            $table->integer('batchuploadresponseimageid');
            $table->integer('parceluserxrefid');
            $table->tinyInteger('isprivate');
            $table->integer('batchuploadresponsecontentid');
            $table->integer('ebaybatchuploadprocessed');
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
        Schema::dropIfExists('batches');
    }
};
