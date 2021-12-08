<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
session_start();

class CheckoutController extends Controller
{
    public function login_checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status' , '0')->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status' , '0')->orderBy('brand_id', 'desc')->get();


        return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = $request->customer_password;
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customers')->insert($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('checkout');
    }

    public function checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status' , '0')->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status' , '0')->orderBy('brand_id', 'desc')->get();


        return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }
}
