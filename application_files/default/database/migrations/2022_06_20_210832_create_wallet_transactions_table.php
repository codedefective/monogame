<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id')->index('transactionPlayer');
            $table->string('currency',5)->default('EUR')->nullable()->index('transactionCurrency');
            $table->decimal('amount', 16,6)->default(0)->nullable(); // 16,6 for coin
            $table->string('type',30)->index('transactionType'); // debit, credit, rollback or promotion or revokedPromotion
            $table->string('transaction_id', 255)->default(null)->nullable()->index('transactionId');
            $table->string('game_cycle', 255)->default(null)->nullable()->index('transactionCycle'); // for slot games
            $table->text('detail')->default(null)->nullable(); // for slot games
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
        Schema::dropIfExists('wallet_transactions');
    }
}
