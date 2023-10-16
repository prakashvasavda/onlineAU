<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NeedsBabysitter extends Model{
    protected $guarded = [];
    protected $table   = 'needs_babysitter';
    protected $fillable = ['id', 'family_id', 'morning', 'afternoon', 'evening', 'night', 'updated_at'];

    public function front_user(){
        return $this->belongsTo(FrontUser::class, 'family_id', 'id');
    }
}
