<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    //
    public $timestamps = false;
    protected $fillable =['provinces_id','attractions_id','attractions_name',
      'Latitude','longitude','description','image_url'
    ];
    
}
