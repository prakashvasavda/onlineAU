<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyFavourite extends Model{
    protected $guarded = [];
    protected $table   = 'family_favourites';
    protected $fillable = [
        'family_id',
        'candidate_id',
        'status',
        'date',
    ];
}
