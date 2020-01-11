<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Coupon;
use Str;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrole');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $users = User::where('id', '!=', $user_id)->get();
        return view('home', compact('users'));
    }
    function contactuploaddownload($file_name) {
      return Storage::download('contacts_uploads/'.$file_name);
    }
    function addcoupon(){
      $coupons = Coupon::paginate(3);
      return view('coupon.index', compact('coupons'));
    }
    function couponinsert(Request $request){
      $request->validate([
        'coupon_code' => 'required|unique:coupons,coupon_code',
        'coupon_validity_date' => 'required',
        'coupon_validity_time' => 'required',
      ]);
      $coupon_validity = $request->coupon_validity_date. " ". $request->coupon_validity_time. ":00";
      if (Str::endsWith($request->discount_amount, '%')) {
        if (Str::before($request->discount_amount, '%') < 100) {
          $after_int = Str::before($request->discount_amount, '%');
          if (is_numeric($after_int)) {
            Coupon::insert([
              'coupon_code' => $request->coupon_code,
              'discount_amount' => $request->discount_amount,
              'coupon_validity' => $coupon_validity,
              'created_at' => Carbon::now(),
            ]);
          }
          else {
            return back()->withErrors('Coupun value must be a number');
          }
        }
        else {
          return back()->withErrors('100 theke boro');
        }
      }
      else {
        if (is_numeric($request->discount_amount)) {
          Coupon::insert([
            'coupon_code' => $request->coupon_code,
            'discount_amount' => $request->discount_amount,
            'coupon_validity' => $coupon_validity,
            'created_at' => Carbon::now(),
          ]);
        }
        else {
          return back()->withErrors('Coupun value must be a number');
        }
      }
      return back()->with('status', 'Coupon Added Sucessfully');
    }
}
