<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('email', 256)->unique();
            $table->string('password', 256);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    
        Schema::create('locations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('lat');
            $table->string('lon');
            $table->string('user_id');
            $table->dateTime('created_at');
        });
    
        Schema::create('social_connections', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('friend_id');
            $table->string('user_id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
