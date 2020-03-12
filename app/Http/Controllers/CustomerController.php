<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class CustomerController extends Controller
{
    function customerdashboard(){
      $sales = Sale::where('user_id', Auth::id())->get();
      return view('customer.dashboard', [
          'sales' => $sales
      ]);
    }
    function downloadpdf($sale_id){
        $pdf = PDF::loadView('pdf.invoice', compact('sale_id'));
        // return $pdf->download('invoice.pdf');
        return $pdf->stream('invoice.pdf');
    }
}
