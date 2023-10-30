<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrontUserSubscription extends Model{
    protected $guarded = [];
    protected $table   = 'front_user_subscriptions';

    public function front_user(){
        return $this->belongsTo(FrontUser::class, 'front_user_id', 'id');
    }
}
