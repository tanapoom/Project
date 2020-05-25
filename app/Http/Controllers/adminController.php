<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attraction;
use App\Province;
use Redirect;
use Illuminate\Support\Facades\File;

class adminController extends Controller
{
    //

    function insertAttraction(Request $request)
    {
      $this->validate($request,[
        'image' => 'required',
        'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
      if ($request->hasFile('image')) {
        $files = $request->file('image');
        foreach($files as $file){
            $filename=$file->getClientOriginalName();
            $file->move('upload',$filename);
            $images[]=$filename;
        }
        $data=implode("|",$images);
      }
        $attraction = new Attraction([
            'provinces_id' => $request->input('province_id'),
            'attractions_name' => $request->input('attractions_name'),
            'Latitude' => $request->input('lat'),
            'longitude' => $request->input('lng'),
            'description' => $request->input('description'),
            'image_url' => $data
        ]);
        $attraction->timestamps = false;
        $attraction->save();
        session()->flash('inserted', 'success');
        return Redirect::to('/admin/insert');
    }
    function insertProvince(Request $request)
    {
        //dd($request->input('province_id'),$request->input('province_name'));
        $province = new Province([
            'provinces_id' => $request->input('province_id'),
            'provinces_name' => $request->input('province_name')
        ]);
        $province->timestamps = false;
        $province->save();
        session()->flash('inserted', 'success');
        return Redirect::to('/admin/insert');
    }
    function edit(Request $request)
    {
        $attraction_id = $request->input('attraction_id');
        $attractions = Attraction::where('attractions_id', $attraction_id)->get()->toArray();
        return view('update')->with('attractions', $attractions);
    }
    function update(Request $request)
    {
      $this->validate($request,[
        'image' => 'required',
        'image.*' => 'image|mimes:jpeg,png,jpg|max:2048'
      ]);
      $attraction_id = $request->input('attractions_id');
      $data = Attraction::where('attractions_id',$attraction_id)->get()->toArray();
      $data_img = $data[0]['image_url'];
      $pics = explode("|",$data_img);
      foreach ($pics as $pic) {
        if(file_exists(public_path('upload/'.$pic))){
          unlink(public_path('upload/'.$pic));
        }

      }
      if ($request->hasFile('image')) {
        /*$file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->move('upload',$filename);*/
        $files = $request->file('image');
        foreach($files as $file){
            $filename=$file->getClientOriginalName();
            $file->move('upload',$filename);
            $images[]=$filename;
        }
        $data=implode("|",$images);
      }
        Attraction::where('attractions_id', $attraction_id)
            ->update([
                'attractions_name' => $request->input('attractions_name'),
                'Latitude' => $request->input('lat'),
                'longitude' => $request->input('lng'),
                'description' => $request->input('description'),
                'image_url' => $data
            ]);
        session()->flash('success', 'success');
        return Redirect::back();
    }
    function deleteAttraction(Request $request)
    {
        $attraction_id = $request->input('attraction_id');
        $data = Attraction::where('attractions_id',$attraction_id)->get()->toArray();
        $data_img = $data[0]['image_url'];
        $pics = explode("|",$data_img);
        foreach ($pics as $pic) {
          if(file_exists(public_path('upload/'.$pic))){
            unlink(public_path('upload/'.$pic));
          }

        }
        $attraction = Attraction::where('attractions_id', $attraction_id);
        $attraction->delete();
        session()->flash('success', 'success');
        return Redirect::back();
    }
    function deleteProvince(Request $request)
    {
        $province_id = $request->input('province_id');
        $attraction = Attraction::where('provinces_id', $province_id)->get()->toArray();
        for ($i=0; $i < count($attraction); $i++) {
          $data = $attraction[$i];
          $data_img = $data['image_url'];
          $pics = explode("|",$data_img);
          foreach ($pics as $pic) {
            if(file_exists(public_path('upload/'.$pic))){
              unlink(public_path('upload/'.$pic));
            }
          }
        }
        $attractions = Attraction::where('provinces_id', $province_id);
        $attractions->delete();
        $province = Province::where('provinces_id', $province_id);
        $province->delete();
        session()->flash('success', 'success');
        return Redirect::to('/admin');
    }
    function search(Request $request)
    {
        $province_id = $request->input('province_id');
        $attractions = Attraction::where('provinces_id', $province_id)->get()->toArray();
        return view('adminsearch')
            ->with('attractions', $attractions);
    }
}
