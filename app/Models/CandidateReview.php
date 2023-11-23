<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateReview extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table   = 'candidate_reviews';
}
