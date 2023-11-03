<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFamilyColumnsToFrontUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('front_users', function (Blueprint $table) {
            $table->string('cell_number')->after('family_address')->nullable();
            $table->string('start_date')->after('cell_number')->nullable();
            $table->string('duration_needed')->after('start_date')->nullable();
            $table->string('candidate_duties')->after('petrol_reimbursement')->nullable();
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
