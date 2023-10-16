<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousExperience extends Model
{
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
