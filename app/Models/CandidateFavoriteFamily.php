<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateFavoriteFamily extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table   = 'candidate_favorite_families';
    protected $fillable = [
        'candidate_id',
        'family_id',
        'date',
    ];
}
