<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'coupon_name', 'coupon_value', 'coupon_time', 'coupon_number', 'coupon_type'
    ];
    protected $primaryKey = 'coupon_id';
    protected $table = 'tbl_coupon';
}
