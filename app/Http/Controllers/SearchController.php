<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class SearchController extends Controller
{
    function search(Request $request){
        // print_r($request->all());
        $q = $request['q'];
        $search_products = QueryBuilder::for(Product::class)
            ->allowedFilters('product_name')
            ->get();
        $search_count = $search_products->count();
        return view("search/search" , compact('search_products', 'search_count'));
    }
}
