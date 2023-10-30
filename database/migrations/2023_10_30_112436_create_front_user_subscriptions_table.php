<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('front_user_id');
            $table->integer('package_id');
            $table->integer('status')->nullable()->default(1);
            $table->date('date');
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
        Schema::dropIfExists('front_user_subscriptions');
    }
}
