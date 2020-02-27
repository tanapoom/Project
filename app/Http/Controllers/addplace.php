<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Attraction;

class addplace extends Controller
{
    public $selecteds = array();

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
        $getselects = Session::get('attraction_id');
        foreach($getselects as $getselect){
          $place = Attraction::where('attractions_id',$getselect )->get()->toArray();
          $this->selecteds=array_merge($this->selecteds,$place);
        }
        return view('selectview')->with('selecteds',$this->selecteds);
      }else {
        return view('selectview');
      }
    }

    function del($id){
      dd($this->selecteds);
    }

    function delAllSelect(Request $request){
      $this->selecteds=array();
      $request->session()->flush();
      return view('search');
    }


}
