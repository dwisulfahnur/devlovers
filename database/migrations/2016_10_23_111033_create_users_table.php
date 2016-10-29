<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name', 50);
            $table->string('email', 70);
            $table->string('username', 50);
            $table->string('password', 100);
            $table->date('dob');
            $table->integer('gender');
            $table->integer('roles_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('profile_picture', 50);
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('roles_id')->references('id')->on('roles');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
