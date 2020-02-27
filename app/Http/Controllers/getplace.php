<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attraction;

class getplace extends Controller
{
    //
    public $places;
    function getdata(Request $request){
      $item=$request->only('province');
      $this->places = Attraction::where('provinces_id',$item)->get()->toArray();
      return view('getview')
      ->with('places',$this->places);
    }


}
