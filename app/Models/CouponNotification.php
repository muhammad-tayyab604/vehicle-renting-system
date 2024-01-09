<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponNotification extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'coupon_code', 'coupon_name', 'max_redemptions', 'amount_off', 'percent_off'];
}