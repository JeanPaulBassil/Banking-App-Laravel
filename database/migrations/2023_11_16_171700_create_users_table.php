<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

    /**
     * Run the migration
     *
     * @return void
    */

    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userName')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['client', 'agent']);
            $table->timestamps();
        });
    }

    /**
     * Reverses the migrations.
     *
     * @return void
     */

     public function down(){
        Schema::dropIfExists('users');
     }
}
