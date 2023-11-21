<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('name');
            $table->string('section');
            $table->string('representative');
            $table->string('gender');
            $table->date('bday');
            $table->string('voterID');
            $table->string('voterKey');
            $table->string('email');
            $table->bigInteger('mobileNo');
            $table->longtext('img');
            $table->string('status');
            $table->string('token');
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
        Schema::dropIfExists('voters');
    }
}
