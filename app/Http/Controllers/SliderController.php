<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Image;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrole');
    }
    function slider(){
      return view('slider.index');
    }
    function sliderinsert(Request $request){
      $slider_info = Slider::create($request->except('_token'));
      if($request->hasFile('slider_photo')){
        $slider_photo = $request->file('slider_photo');
        $new_name = $slider_info->id . '.' . $slider_photo->getClientOriginalExtension();
        $save_location = "public/uploads/sliders/".$new_name;
        Image::make($slider_photo)->resize(1920, 950)->save(base_path($save_location));
        $slider_info->slider_photo = $new_name;
        $slider_info->save();
      }
      return back()->withStatus('Your Slider Has Been Added');
    }
}
