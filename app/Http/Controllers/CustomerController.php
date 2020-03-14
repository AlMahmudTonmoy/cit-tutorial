<?php

namespace App\Http\Controllers;

use App\Invoice;
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
        $invoices = Invoice::where('sale_id', $sale_id)->with('relationtoproducttable')->get();
        $pdf = PDF::loadView('pdf.invoice', compact('sale_id', 'invoices'));
        return $pdf->stream('invoice.pdf');
    }
}
