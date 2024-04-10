<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyReview extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table   = 'family_reviews';
    protected $fillable = [
        'family_id',
        'candidate_id',
        'review_rating_count',
        'review_note',
        'date',
    ];

    public function front_user(){
        return $this->belongsTo(FrontUser::class, 'family_id', 'id');
    }
}
