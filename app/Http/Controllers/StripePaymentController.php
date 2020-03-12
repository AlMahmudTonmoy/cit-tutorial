<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Product;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Stripe;
use App\Sale;
use Illuminate\Support\Facades\Auth;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function stripe(Request $request)
    {
        // print_r($request->all());
        // die();
        return view('payment.stripe', [
            'total_to_pay' => $request->total_to_pay,
            'all_previous_data' => $request->all()
        ]);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $request->total_to_pay * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Payment from Boighor.com"
        ]);

        Session::flash('success', 'Payment successful!');
        $all_previous_data_as_array = json_decode($request->all_previous_data, true);
        $sale_id = Sale::insertGetId([
            'user_id' => Auth::id(),
            'cart_subtotal' => getcarttotalprice(),
            'coupon_code' => $all_previous_data_as_array['coupon_code'],
            'order_total' => $all_previous_data_as_array['order_total_input'],
            'shipping_charge' => $all_previous_data_as_array['shipping_charge'],
            'payment_method' => 1,
            'created_at' => Carbon::now()

        ]);

        foreach (getcartproducts() as $key => $value) {
            Invoice::insert([
            "user_id" => Auth::id(),
            "sale_id" => $sale_id,
            "product_id" => $value->product_id,
            "quantity" => $value->quantity,
            'created_at' => Carbon::now()
        ]);
                Product::find($value->product_id)->decrement('product_quantity', $value->quantity);
        //delete sale table item
            $value->delete();
        }
        return redirect('cart');
    }
}
