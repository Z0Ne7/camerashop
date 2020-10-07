<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'nameWard', 'typeWard', 'idProvince'
    ];
    protected $primaryKey = 'idWard';
    protected $table = 'tbl_ward';
}
