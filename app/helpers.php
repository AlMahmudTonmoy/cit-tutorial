<?php

function getcartamount(){
  $MAC = exec('getmac');
  $mac = strtok($MAC, ' ');
  return $cart_amount = App\Cart::where('mac', $mac)->count();
}

function getcartproducts(){
  $MAC = exec('getmac');
  $mac = strtok($MAC, ' ');
  return $cart_amount = App\Cart::where('mac', $mac)->orderBy('id', 'desc')->get();
}

function getcarttotalprice(){
  $MAC = exec('getmac');
  $mac = strtok($MAC, ' ');
  $cart_products = App\Cart::where('mac', $mac)->get();
  $final_amount = 0;
  foreach ($cart_products as $cart_product) {
    $final_amount += $cart_product->relationtoproducttable->product_price * $cart_product->quantity;
  }
  return $final_amount;
}
