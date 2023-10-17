<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyReview extends Model{
    protected $guarded = [];
    protected $table   = 'family_reviews';
    protected $fillable = [
        'family_id',
        'candidate_id',
        'review_rating_count',
        'review_note',
        'date',
    ];
}
