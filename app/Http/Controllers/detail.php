<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attraction;
class detail extends Controller
{
    //
    function showdetail($id){
      $details = Attraction::where('attractions_id',$id)->get()->toArray();
      return view('viewdetail')
      ->with('details',$details);
    }
}
