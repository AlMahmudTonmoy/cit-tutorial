<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Carbon\Carbon;
use App\Product;
use App\Coupon;

class CartController extends Controller
{
    function addtocart(Request $request){
      $MAC = exec('getmac');
      $mac = strtok($MAC, ' ');
      $available_quantity = Product::find($request->product_id)->product_quantity;
      $cart_info = Cart::where('mac', $mac)->where('product_id', $request->product_id)->first();
      if ($cart_info) {
        $old_cart_quantity = $cart_info->quantity;
      }
      else {
        $old_cart_quantity = 0;
      }
      if ($available_quantity >= ($request->quantity + $old_cart_quantity)) {
        if ($cart_info) {
          Cart::where('mac', $mac)->where('product_id', $request->product_id)->increment('quantity', $request->quantity);
        }
        else {
          Cart::insert([
            "mac" => $mac,
            "product_id" => $request->product_id,
            "quantity" => $request->quantity,
            "created_at" => Carbon::now(),
          ]);
        }
      }
      else {
        echo "Not AVailable amount";
        return back()->with('error', 'Not AVailable amount');
      }
      return back()->with('success', 'Product Added to Cart');
    }


    function cart($coupon_code = ""){
      if ($coupon_code == "") {
        $coupon_discount_amount = 0;
        return view('cart', compact('coupon_discount_amount', 'coupon_code'));
      }
      else {
        if (Coupon::where('coupon_code', $coupon_code)->exists()) {
          $soupon_validity = Coupon::where('coupon_code', $coupon_code)->first()->coupon_validity;
          $todays_date = Carbon::now();
          if ($soupon_validity > $todays_date) {
            $coupon_discount_amount = Coupon::where('coupon_code', $coupon_code)->first()->discount_amount;
          }
          else {
            return back()->withErrors('"'.$coupon_code.'"' . ' Coupon Already Expired');
          }
        }
        else {
          return back()->withErrors('Invalid Coupon');
        }
        return view('cart', compact('coupon_discount_amount', 'coupon_code'));
      }

    }


    function cartdelete($cart_id){
      Cart::find($cart_id)->delete();
      return back();
    }


    function cartupdate(Request $request){
      foreach ($request->cart_id as $key => $value) {
        $cart_id = $value;
        $product_id = Cart::find($cart_id)->product_id;
        $updated_amount = $request->cart_amount[$key];
        $available_amount = Product::find($product_id)->product_quantity;
        if ($available_amount >= $updated_amount) {
          Cart::find($value)->update([
            "quantity" => $updated_amount,
          ]);
        }
        // else {
        //   echo "hobe na";
        // }
      }
      return back();
    }
}
