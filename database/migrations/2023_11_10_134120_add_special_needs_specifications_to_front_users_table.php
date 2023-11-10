<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpecialNeedsSpecificationsToFrontUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('front_users', function (Blueprint $table) {
            $table->string('special_needs_specifications')->nullable()->after('candidate_duties');
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
