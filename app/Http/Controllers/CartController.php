<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
session_start();

class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status' , '0')->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status' , '0')->orderBy('brand_id', 'desc')->get();

        $productId = $request->productid_hidden;
        $quantity =  $request->qty;
        $data = DB::table('tbl_product')->where('product_id', $productId)->get();

        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product);

    }
}
