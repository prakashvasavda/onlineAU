<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Packages extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table   = 'packages';

    protected $fillable = [
        'name',
        'candidate',
        'price',
        'duration',
        'cancellation_notice_period',
        'cancellation_allowed',
    ];

    protected $dates = ['deleted_at'];

    public function userSubscriptions(){
        return $this->belongsTo(UserSubscription::class, 'package_id');
    }
}
