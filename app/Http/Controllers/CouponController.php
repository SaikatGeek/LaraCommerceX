<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){

    	if ($request->isMethod("post")) {

            $request->validate([
                'coupon_name'       => 'unique:coupons,coupon_name|required',
                'discount_amount'   => 'numeric|max:100',
                'valid_till'        => 'required|date|after:today'

            ]);


    		Coupon::insert([
    			'coupon_name' => $request->coupon_name,
    			'discount_amount' => $request->discount_amount,
    			'valid_till' => $request->valid_till,
    			'created_at' => Carbon::now(),
    		]);

    		return back()->with('status', 'Coupon Added Successfully!');
    	}
    	else{

    	  $Coupons = Coupon::all();

    	  return view('coupon/view', compact('Coupons'));
    	}

    }

    




}
