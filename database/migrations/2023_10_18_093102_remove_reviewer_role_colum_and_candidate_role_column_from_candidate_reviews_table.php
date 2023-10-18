<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveReviewerRoleColumAndCandidateRoleColumnFromCandidateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_reviews', function (Blueprint $table) {
            $table->dropColumn('candidate_role');
            $table->dropColumn('reviewer_role');
            $table->renameColumn('reviewer_id', 'family_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_reviews', function (Blueprint $table) {
            //
        });
    }
}
