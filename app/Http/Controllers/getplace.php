<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attraction;

class getplace extends Controller
{
    //
    function getdata(Request $request){
      $item=$request->input('province');
      $places = Attraction::where('provinces_id',$item)->get()->toArray();
      return view('getview')
      ->with('places',$places);
    }


}
