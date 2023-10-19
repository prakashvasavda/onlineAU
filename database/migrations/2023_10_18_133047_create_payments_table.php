<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('name_first')->nullable();
            $table->string('name_last')->nullable();
            $table->string('email_address')->nullable();
            $table->string('item_name')->nullable();
            $table->string('item_description')->nullable();
            $table->string('m_payment_id')->nullable();
            $table->string('amount_gross')->nullable();
            $table->string('amount_fee')->nullable();
            $table->string('amount_net')->nullable();           
            $table->string('pf_payment_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('signature')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
