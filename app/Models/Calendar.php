<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calendar extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'front_user_id',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'status',
    ];

    public function front_user(){
        return $this->belongsTo(FrontUser::class, 'front_user_id', 'id');
    }
}
