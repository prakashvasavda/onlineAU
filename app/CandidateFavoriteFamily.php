<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateFavoriteFamily extends Model{
    protected $guarded = [];
    protected $table   = 'candidate_favorite_families';
    protected $fillable = [
        'candidate_id',
        'family_id',
        'date',
    ];
}
