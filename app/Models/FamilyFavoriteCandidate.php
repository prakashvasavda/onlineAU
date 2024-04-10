<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyFavoriteCandidate extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table   = 'family_favorite_candidates';
    protected $fillable = [
        'family_id',
        'candidate_id',
        'date',
    ];
}
