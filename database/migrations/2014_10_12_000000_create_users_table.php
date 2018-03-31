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
            $table->string('user_id', 20)->unique();
            $table->string('name', 32);
            $table->string('email', 256)->unique();
            $table->string('image', 64)->nullable();
            $table->integer('now_point');
            $table->unsignedTinyInteger('status');
            $table->ipAddress('ip');
            $table->string('host', 256);
            $table->string('user_agent', 256);
            $table->string('password');
            $table->rememberToken();
            $table->timestampsTz();
            $table->softDeletesTz();
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
