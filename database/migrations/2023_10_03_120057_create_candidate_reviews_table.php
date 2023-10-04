<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('candidate_id');
            $table->integer('reviewer_id');
            $table->string('reviewer_role');
            $table->string('review_rating_count') ;
            $table->longText('review_note');
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
        Schema::dropIfExists('candidate_reviews');
    }
}
