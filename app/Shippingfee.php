<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shippingfee extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'fee_idCity', 'fee_idProvince', 'fee_idWard', 'fee_value'
    ];
    protected $primaryKey = 'fee_id';
    protected $table = 'tbl_shippingfee';

    public function city(){
    	return $this->belongsTo('App\City','fee_idCity');
    }
    public function province(){
    	return $this->belongsTo('App\Province','fee_idProvince');
    }
    public function ward(){
    	return $this->belongsTo('App\Ward','fee_idWard');
    }
}
