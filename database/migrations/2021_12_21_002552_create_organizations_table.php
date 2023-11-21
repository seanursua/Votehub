<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('orgName')->unique();
            $table->string('lname');
            $table->string('fname');
            $table->string('mname');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('NoS');
            $table->string('PoS');
            $table->string('Profile');
            $table->string('Status');
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
        Schema::dropIfExists('organizations');
    }
}
