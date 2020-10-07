<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'customer_id', 'order_status', 'order_code', 'order_payment', 'order_shipping_name', 'order_shipping_phone','order_shipping_address','order_idCity','order_idProvince','order_idWard', 'order_couponcode', 'order_shippingfee', 'created_at'
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';

}
