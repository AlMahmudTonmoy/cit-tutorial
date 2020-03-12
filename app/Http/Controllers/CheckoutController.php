<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\City;
use App\coupon;

class CheckoutController extends Controller
{
    function checkout($coupon_code = ""){
        if ($coupon_code == "") {
                $discount_amount = 0;
            }
        else {
                $discount_amount = coupon::where('coupon_code', $coupon_code)->first()->discount_amount;
            }
      return view('checkout', [
            'countries' => Country::all(),
            'coupon_code' => $coupon_code,
            'discount_amount' => $discount_amount
      ]);
    }
    function getcitylist(Request $request){
      $dropdown = '<option value="">Select a country…</option>';
      $cities = City::where('country_id', $request->country_id)->get();
      foreach($cities as $city) {
        $dropdown .= '<option value="'. $city->id . '">'. $city->name . '</option>';
      }
      echo $dropdown;
    }
}
