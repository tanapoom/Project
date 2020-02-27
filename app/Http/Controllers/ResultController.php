<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Attraction;
use GuzzleHttp\Client;
use Redirect;

class ResultController extends Controller
{

  public $results = array();
  function getresult(Request $request){
    $getselects = Session::get('attraction_id');
    $lat=$request->only('lat');
    $lng=$request->only('lng');
    $url= $this->geturl(data_get($lat,'lat'),data_get($lng,'lng'),$getselects);
    $getselects = $this->getdistance($url,$getselects);

    do {
      $place = Attraction::where('attractions_id',end($this->results) )->get()->toArray();
      foreach ($place as $p) {
        $lat=$p["Latitude"];
        $lng=$p["longitude"];
      }
      $url=$this->geturl($lat,$lng,$getselects);
      $getselects = $this->getdistance($url,$getselects);
      $c=count($getselects);
    } while ($c!=1);

    foreach ($getselects as $getselect) {
      array_push($this->results,$getselect["id"]);
    }
    Session::put('result', 'have');
    $dataresults=array();
    foreach($this->results as $result){
      $dataresult = Attraction::where('attractions_id',$result )->get()->toArray();
      $dataresults=array_merge($dataresults,$dataresult);
    }
    return view('result')->with('dataresults',$dataresults);


  }

  public function geturl($lat,$lng,$getselects){
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat.",".$lng."&destinations=";
    $i=1;
    foreach ($getselects as $getselect) {
      $place = Attraction::where('attractions_id',$getselect["id"] )->get()->toArray();
      foreach ($place as $p) {
        $deslat=$p["Latitude"];
        $deslng=$p["longitude"];
        $url .= $deslat.",".$deslng;
      }
      if($i!=count($getselects)){
        $i++;
        $url .= "|";
      }else {
        $url .= "&key=AIzaSyAQLj-_PEe0qXFXtqhs_EdE-ZmC5zoReMs";
      }
    }
    return $url;
  }

  public function getdistance($url,$getselects){
    $mindistance = null;
    $index=null;
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', $url);
    $data = $response->getBody();
    $get_rows = json_decode($data, true);
    $get_elements = $get_rows["rows"];
    $get_distance = $get_elements[0];
    $get_value = $get_distance["elements"];
    for ($i=0; $i < count($get_value); $i++) {
      $text = $get_value[$i]["distance"]["text"];
      $split= explode(" ",$text);
      $distance = floatval($split[0]);
      if($mindistance==null){
        $mindistance = $distance;
        $index=$i;
      }else {
        if ($mindistance>=$distance) {
          $mindistance = $distance;
          $index=$i;
        }
      }
    }
    $i=0;
    foreach ($getselects as $getselect) {
      if($i==$index){
        $index=array_search($getselect, $getselects);
        array_push($this->results,$getselects[$index]["id"]);
        unset($getselects[$index]);
      }
      $i++;
    }
    return $getselects;
  }


}
