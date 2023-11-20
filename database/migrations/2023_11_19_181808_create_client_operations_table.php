<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientOperationsTable extends Migration {

    /**
     * Run the migration
     *
     * @return void
     */

    public function up(){
        Schema::create('client_operations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('operation_type');
            $table->text('operation_details')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverses the migrations.
     *
     * @return void
     */

    public function down(){
        Schema::dropIfExists('client_operations');
    }
}
