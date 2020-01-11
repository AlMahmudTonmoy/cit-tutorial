<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_gallery;
use App\Category;
use Carbon\Carbon;
use Image;
use App\Http\Requests\ProductFormValidation;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        // $this->middleware('checkrole');
    }
    function product (){
      $products = Product::withTrashed()->get();
      $categories = Category::all();
      return view('product.index', compact('products', 'categories'));
    }
    //ProductFormValidation
    function productinsert (Request $request){
      $product_id = Product::insertGetId([
        'product_name' => $request->product_name,
        'product_short_description' => $request->product_short_description,
        'product_long_description' => $request->product_long_description,
        'category_id' => $request->category_id,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'alert_quantity' => $request->alert_quantity,
        'created_at' => Carbon::now(),
      ]);
      if($request->hasFile('product_photo')){
        $product_photo = $request->file('product_photo');
        $new_name = $product_id . '.' . $product_photo->getClientOriginalExtension();
        $save_location = "public/uploads/product_photos/".$new_name;
        Image::make($product_photo)->resize(450, 565)->save(base_path($save_location));
        Product::findOrFail($product_id)->update([
          'product_photo' => $new_name
        ]);
      }
      if($request->hasFile('product_gallery')){
        $initial = 1;
        foreach ($request->product_gallery as $single_product_gallery) {
          $new_name = $initial . '.' . $single_product_gallery->getClientOriginalExtension();
          $initial++;
          $save_location = "public/uploads/product_gallery/".$product_id."-".$new_name;
          Image::make($single_product_gallery)->resize(450, 565)->save(base_path($save_location));
          Product_gallery::insert([
            'product_id' => $product_id,
            'gallery_image' => $product_id."-".$new_name,
            'created_at' => Carbon::now(),
          ]);
        }
      }
      return back()->with('status', 'Product Inserted Succesfully!');
    }
    function productdelete ($product_id){
      $product_name = Product::findorfail($product_id)->product_name;
      Product::findorfail($product_id)->delete();
      return back()->withDelete_status($product_name . ' Deleted Succesfully!');
    }
    function productrestore ($product_id){
      Product::withTrashed()->where('id', $product_id)->restore();
      return back();
    }
    function productforcedelete ($product_id){
      Product::withTrashed()->where('id', $product_id)->forceDelete();
      return back();
    }
    function productedit ($product_id){
      $product_info = Product::findorfail($product_id);
      $categories = Category::all();
      return view('product.edit', compact('product_info', 'categories'));
    }
    function productupdate (ProductFormValidation $request){
      if ($request->hasFile('new_photo')) {
        if (Product::findorfail($request->product_id)->product_photo != 'defaultproductphoto.jpg') {
           unlink(base_path('public/uploads/product_photos/'.Product::findorfail($request->product_id)->product_photo));
           //to upload new image
        }
        $product_photo = $request->file('new_photo');
        $new_name = $request->product_id . '.' . $product_photo->getClientOriginalExtension();
        $save_location = "public/uploads/product_photos/".$new_name;
        Image::make($product_photo)->resize(270, 340)->save(base_path($save_location));
        Product::findOrFail($request->product_id)->update([
          'product_photo' => $new_name
        ]);
      }
      Product::findorfail($request->product_id)->update([
        'product_name' => $request->product_name,
        'category_id' => $request->category_id,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'alert_quantity' => $request->alert_quantity,
      ]);
        return redirect('product')->withEdit_status($request->product_name. ' Edited Succesfully!');
    }
}
