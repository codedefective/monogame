<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index('userPromotionIndex');
            $table->unsignedBigInteger('promotion_id')->index('userPromotionPromoId');
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
        Schema::dropIfExists('user_promotions');
    }
}
