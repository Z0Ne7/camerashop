<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'nameCity', 'typeCity'
    ];
    protected $primaryKey = 'idCity';
    protected $table = 'tbl_city';
}
