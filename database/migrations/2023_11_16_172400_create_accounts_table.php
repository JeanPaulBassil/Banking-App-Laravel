<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration{

    /**
     * Run the migration
     *
     * @return void
     */

    public function up(){
        Schema::create("accounts", function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("user_id");
            $table->string("account_number")->unique();
            $table->enum('currency', ['LBP', 'EUR', 'USD']);
            $table->decimal('balance', 15, 2);
            $table->enum('status', ['Active', 'Pending']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Revert the migration
     *
     * @return void
     */

    public function down(){
        Schema::dropIfExists('accounts');
    }
}
