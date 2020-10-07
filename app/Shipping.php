<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'customer_id', 'idCity', 'idProvince', 'idWard', 'shipping_name', 'shipping_address', 'shipping_phone'
    ];
    protected $primaryKey = 'shipping_id';
    protected $table = 'tbl_shipping';
    public function city(){
    	return $this->belongsTo('App\City','idCity');
    }
    public function province(){
    	return $this->belongsTo('App\Province','idProvince');
    }
    public function ward(){
    	return $this->belongsTo('App\Ward','idWard');
    }
}
