<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSavedByRoleToCandidateFavouritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_favourites', function (Blueprint $table) {
             $table->string('saved_by_role')->after('saved_by_id');
             $table->date('date')->nullable()->after('candidate_role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_favourites', function (Blueprint $table) {
            //
        });
    }
}
