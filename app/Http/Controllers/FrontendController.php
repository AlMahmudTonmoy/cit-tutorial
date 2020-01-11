<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Contact;
use App\Slider;
use App\User;
use Hash;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    function index () {
      $products = Product::all();
      $sliders = Slider::all();
      $categories = Category::all();
      return view('welcome', compact('products', 'sliders', 'categories'));
    }
    function contact () {
      return view('contact');
    }

    function about () {
      return view('about');
    }
    function contactsubmit (Request $request){
      if ($request->hasFile('upload_file')) {
        $last_id = Contact::insertGetId($request->except('_token') + [
          'created_at' => Carbon::now()
        ]);
        $uploaded_file = $request->file('upload_file');
        // Storage::put('contacts_uploads', $uploaded_file);
        $path = $request->file('upload_file')->storeAs(
            'contacts_uploads', $last_id.'.'.$uploaded_file->getClientOriginalExtension()
        );
        Contact::find($last_id)->update([
          'upload_file' => $last_id.'.'.$uploaded_file->getClientOriginalExtension()
        ]);
        echo $path;
      }
      else {
        Contact::insertGetId($request->except('_token') + [
          'upload_file' => 'not inserted',
          'created_at' => Carbon::now()
        ]);
      }
      // return back()->withStatus('your message has been recieved');
      return redirect('contact#contact_form')->withStatus('your message has been recieved');
    }
    function productdetals($fproduct_id, $fproduct_slug){
      $fproduct_info = Product::find($fproduct_id);
      $related_products = Product::where('category_id', $fproduct_info->category_id)->where('id', '!=', $fproduct_id)->get();
      return view('product_details', compact('fproduct_info', 'related_products'));
    }
    function customerregister(){
      return view('customerregister');
    }
    function customerregisterinsert(Request $request){
      User::insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 2,
        'created_at' => Carbon::now(),
      ]);
      return back()->withSuccess('Account Created Successfully! To login <a href="'. url('login') .'">Click Here</a>');
    }

}
