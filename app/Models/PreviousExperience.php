<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousExperience extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table   = 'previous_experience';
    protected $fillable = [
        'candidate_id',
        'daterange',
        'heading',
        'description',
        'reference',
        'tel_number',
    ];

    public function front_user(){
        return $this->belongsTo(FrontUser::class, 'candidate_id', 'id');
    }
}
