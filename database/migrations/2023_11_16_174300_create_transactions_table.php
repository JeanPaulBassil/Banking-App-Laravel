<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration{
    /**
     * Run the migration
     *
     * @return void
     */

    public function up(){
        Schema::create("transactions", function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("account_id");
            $table->enum('type', ['deposit', 'withdrawal']);
            $table->decimal('amount', 15, 2);
            $table->enum('currency', ['LBP', 'EUR', 'USD']);
            $table->dateTime('transaction_date');
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }


    /**
     * Reverts the migration
     *
     * @return void
     */

    public function down(){
        Schema::dropIfExists('transactions');
    }
}
