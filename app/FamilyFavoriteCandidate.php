<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyFavoriteCandidate extends Model{
    protected $guarded = [];
    protected $table   = 'family_favorite_candidates';
    protected $fillable = [
        'family_id',
        'candidate_id',
        'date',
    ];
}
