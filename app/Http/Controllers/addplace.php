<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Attraction;

class addplace extends Controller
{
    public $amount=0;
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
      //return redirect()->route('getplace.getdata')
      return Redirect::back();
    }

    function showselect(){
      if (Session::has('attraction_id')) {
        $selecteds = array();
        $getselects = Session::get('attraction_id');
        foreach($getselects as $getselect){
          $place = Attraction::where('attractions_id',$getselect )->get()->toArray();
          $selecteds=array_merge($selecteds,$place);
        }
        return view('selectview')->with('selecteds',$selecteds);
      }else {
        return view('selectview');
      }
    }

    function del(Request $request){
      $id=$request->only('id');
      $getselects = Session::get('attraction_id');
      $newgetselects=array();
      foreach($getselects as $getselect){
        if($getselect!=$id){
          array_push($newgetselects,$getselect);
          $request->session()->put('attraction_id',$newgetselects);
        }
      }
      if ($newgetselects==null) {
        $request->session()->forget('attraction_id');
      }
      return Redirect::to('selectview');
      //return redirect('del','/search');
      //return view('selectview')->with('selecteds',$selecteds);
    }

    function delAllSelect(Request $request){
      $request->session()->flush();
      return Redirect::to('/');
    }


}
