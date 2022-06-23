<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id',false)->index('walletPlayer');
            $table->string('currency',5)->default('EUR')->nullable()->index('walletCurrency');
            $table->integer('wallet_type')->default(1)->nullable()->index('walletType'); // 1 REAL 2 BONUS 3 COUPON 4 FREE SPIN
            $table->string('host',100)->default('https://monowallet.com/api/v3/transaction')->nullable();
            $table->decimal('balance',16,6)->default(0)->nullable(); // 16,6 for coin
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
        Schema::dropIfExists('wallets');
    }
}
