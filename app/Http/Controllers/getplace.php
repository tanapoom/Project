<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Attraction;
class getplace extends Controller
{
    //
    public $places;
    function getdata(Request $request){
    /*  $client = new \GuzzleHttp\Client();
      $response = $client->request('GET', 'https://tatapi.tourismthailand.org/tatapi/v5/places/search?categorycodes=RESTAURANT', [
        'headers' => [
          //'Content-Type' => 'application/json',
          'Authorization' => 'G)LjeSbjx2e61rtD1gHe4uTRpVrdyF0qi)5rv9PU7v4mv(hz9gR41LRL)lZYlD1cD6hAGRSPT49ZzrMQCWvZjtm=====2',
          //'Accept-Language' => 'en'
        ]
      ]);
      echo $response->getStatusCode().'<br>';
    //  echo $response->getBody();
      $data = $response->getBody();
      return view('getview')
      ->with('test',$data);
      $response = $client->request('GET','https://mypro-a9811.firebaseio.com/.json');
      $data=$response->getBody() ;
      //$get_result=json_decode($data,true);   */
      $item=$request->only('province');
      $this->places = Attraction::where('provinces_id',$item)->get()->toArray();
      return view('getview')
      ->with('places',$this->places);
    }


}
