<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('code',12)->unique();
            $table->dateTime('start_date')->index('promotionStartDate');
            $table->dateTime('end_date')->index('promotionEndDate');
            $table->decimal('amount', 16,6)->default(0)->nullable(); // 16,6 for coin
            $table->string('currency',5)->default('EUR')->nullable()->index('promotionCurrency');
            $table->integer('quota',false)->default(1)->nullable();
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
        Schema::dropIfExists('promotions');
    }
}
