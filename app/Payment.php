<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Payment extends Model{
    use SoftDeletes;

    protected $guarded = [];
    protected $table   = 'payments';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'merchant_id',
        'user_subscription_id',
        'name_first',
        'name_last',
        'email_address',
        'item_name',
        'item_description',
        'm_payment_id',
        'amount_gross',
        'amount_fee',
        'amount_net',
        'pf_payment_id',
        'payment_status',
        'signature',
    ];

}
