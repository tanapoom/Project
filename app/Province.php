<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    public $timestamps = false;
    protected $fillable =['provinces_id','provinces_name'];
}
