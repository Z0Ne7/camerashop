<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'nameProvince', 'typeProvince', 'idCity'
    ];
    protected $primaryKey = 'idProvince';
    protected $table = 'tbl_province';
}
