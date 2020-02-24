<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Attraction;

class addplace extends Controller
{
    //
    function add(Request $request){
      $id=$request->only('id');
      $addPlace = Session::has('attraction_id') ? Session::get('attraction_id') : null;
      if ($addPlace==null) {
        $addPlace= array();
        array_push($addPlace,$id);
        $request->session()->put('attraction_id',$addPlace);
      }else {
        $have=false;
        for ($i=0; $i < count($addPlace) ; $i++) {
          if ($addPlace[$i]==$id) {
            $have=true;
            break;
          }
        }
        if($have==false){
          array_push($addPlace,$id);
          $request->session()->put('attraction_id',$addPlace);
        }
      }
      //$request->session()->flush();
      //return redirect()->route('getplace.getdata');
      return Redirect::back();
    }

    function showselect(){
      if (Session::has('attraction_id')) {
        $places= array();
        $getselects = Session::get('attraction_id');
        foreach($getselects as $getselect){
          $place = Attraction::where('attractions_id',$getselect )->get()->toArray();
          $places=array_merge($places,$place);
        }
        return view('direction')->with('places',$places);
      }else {
        return view('direction');
      }
    }

    function delAllSelect(Request $request){
      $request->session()->flush();
      return Redirect::back();
    }

}
