<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferTable extends Migration{

    /**
     * Run the migration
     *
     * @return void
     */

    public function up(){
        Schema::create("transfers", function (Blueprint $table){
            $table->bigIncrements("id");
            $table->unsignedInteger("from_account_id");
            $table->unsignedInteger("to_account_id");
            $table->decimal('amount', 15, 2);
            $table->enum('currency', ['LBP', 'USD', 'EUR']);
            $table->enum('status', ['approved', 'declined', 'pending']);
            $table->timestamps();

            $table->foreign('from_account_id')->references('id')->on('accounts');
            $table->foreign('to_account_id')->references('id')->on('accounts');
        });
    }

    /**
     * Revert the migration
     *
     * @return void
     */

     public function down(){
        Schema::dropIfExists('transfers');
     }
}
