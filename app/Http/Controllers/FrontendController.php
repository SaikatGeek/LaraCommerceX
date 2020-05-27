<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Category;
use Carbon\Carbon;
use App\Contact;
use App\Coupon;
use Mail;
use App\Mail\ContactMessage;

class FrontendController extends Controller
{
    function contact(){
    	return view('contact');
    }
    
    
    function contactinsert(Request $request){

        Contact::insert($request->except('_token'));
        //Send Mail to the company

        $message = $request->message;
        $first_name = $request->first_name;

        Mail::to('amtarek26@gmail.com')->send(new ContactMessage($message, $first_name));
        
        
        return back()->with('status', 'MSG SENT SUCCESSFULLY');
        //return redirect('link here');
    }



    function Index(){

    	$products = Product::all();
        $categories = Category::all();

    	return view('welcome', compact('products', 'categories'));

    	
    }



    function productdetails($p_id){

        $single_Product_Info = Product::find($p_id);
        $related_products = Product::where('id', '!=', $p_id)->where('category_id', $single_Product_Info->category_id)->get();
    	return view('frontend/productdetails', compact('single_Product_Info', 'related_products'));
    }

    function categorywiseproduct( $category_id ){

        $products = Product::where('category_id', $category_id)->get();
        $category_name = Category::find($category_id);
        return view('frontend/categorywiseproduct', compact('products', 'category_name'));


    }

    function addtocart( $product_id ){

        $ip_address = $_SERVER['REMOTE_ADDR'];

        if (Cart::where('customer_ip', $ip_address)->where('product_id', $product_id)->exists()) {
            
            Cart::where('customer_ip', $ip_address)->where('product_id', $product_id)->increment('product_quantity', 1);


        }

        else{
        
        Cart::insert([
            'customer_ip'=> $ip_address,
            'product_id'=> $product_id,
            'created_at'=> Carbon::now()
        ]);

        }
        

        return back();

    }

    function cart($coupon_name = ""){
        if ($coupon_name == "") {
            $cart_items = Cart::where('customer_ip', $_SERVER['REMOTE_ADDR'])->get();
            $cart_discount_amount = 0;
            return view('frontend/cart', compact('cart_items', 'cart_discount_amount', 'coupon_name'));
        }
        else{
            
            if (Coupon::where('coupon_name', $coupon_name)->exists()) {
               $DATE = Carbon::now()->format('Y-m-d');
               $VALIDTILL = Coupon::where('coupon_name', $coupon_name)->first()->valid_till;               

               if ($DATE <= $VALIDTILL) {
                    $cart_items = Cart::where('customer_ip', $_SERVER['REMOTE_ADDR'])->get();
                    $cart_discount_amount = Coupon::where('coupon_name', $coupon_name)->first()->discount_amount;
                    return view('frontend/cart', compact('cart_items', 'cart_discount_amount', 'coupon_name'));
               }
               else{
                   echo "Not Valid";
               }
            }
            else{
                echo "Invalid";
            }
        }


    }

    function deletefromcart( $cart_id ){

        Cart::find($cart_id)->delete();
        return back();
    }

    function clearcart( ){

        Cart::where('customer_ip', $_SERVER['REMOTE_ADDR'])->delete();
        return back();
    }




}
