<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubscription extends Model{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table   = 'user_subscriptions';

    protected $fillable = [
        'user_id',
        'payment_id',
        'package_id',
        'start_date',
        'end_date',
        'cancellation_approval_status',
        'cancellation_request_status',
        'status',
    ];

    protected $dates = ['deleted_at'];

    public function front_user(){
        return $this->belongsTo(FrontUser::class, 'user_id', 'id');
    }

    public function packages(){
        return $this->hasMany(Packages::class, 'package_id');
    }
}
