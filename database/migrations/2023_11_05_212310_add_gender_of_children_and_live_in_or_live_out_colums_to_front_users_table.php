<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderOfChildrenAndLiveInOrLiveOutColumsToFrontUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('front_users', function (Blueprint $table) {
            $table->string('gender_of_children')->after('ages_of_children_you_worked_with')->nullable();
            $table->string('live_in_or_live_out')->after('gender_of_children')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('front_users', function (Blueprint $table) {
            //
        });
    }
}