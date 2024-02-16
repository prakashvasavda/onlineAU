<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    // public function packages(){
    //     return $this->hasMany(Packages::class);
    // }

    protected function serializeDate(DateTimeInterface $date): string{
        return $date->format('Y-m-d H:i:s');
    }
}
