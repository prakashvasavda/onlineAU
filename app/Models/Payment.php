<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;



class Payment extends Model
{
    use HasFactory;

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

    protected function serializeDate(DateTimeInterface $date): string{
        return $date->format('Y-m-d H:i:s');
    }
}
