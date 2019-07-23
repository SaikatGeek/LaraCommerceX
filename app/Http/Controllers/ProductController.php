<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Image;

class ProductController extends Controller
{



    function addproductview(){
    	
    	 $products = Product::simplePaginate(9);
    	 $deleted_products = Product::onlyTrashed()->get();
         $categories    =   Category::all();
    	 return view('product/view', compact('products', 'deleted_products', 'categories'));
    }
    
    function addproductinsert(Request $request){
    	//echo "string<br>";
    	//print_r($_POST['product_name']);
    	//echo $request->product_price;

    	//print_r($request->all());

        


    	$request->validate([
    		'category_id'=>'required',
            'product_name'=>'required',
    		'product_description'=>'required',
    		'product_price'=>'required|numeric',
    		'product_quantity'=>'required|numeric',
    		'alert_quantity'=>'required|numeric',
    	]);

    	$Last_inserted_id = Product::insertGetId([
    		//Table_field_name => Form_field_name
    		'category_id' => $request->category_id,
            'product_name' => $request->product_name,
    		'product_description' => $request->product_description,
    		'product_price' => $request->product_price,
    		'product_quantity' => $request->product_quantity,
    		'alert_quantity' => $request->alert_quantity

    	]);

        if ($request->hasFile('product_image')) {
            $photo_to_upload = $request->product_image;
            $filename = $Last_inserted_id.".".$photo_to_upload->getClientOriginalExtension();// create New File name
            
            //$photo_to_upload->getClientOriginalExtension()----> Get name of file extension
            
            $image = Image::make($photo_to_upload)->resize(400, 450)->save(base_path('public/uploads/product_photos/'.$filename));
            Product::find($Last_inserted_id)->update([
                'product_image' => $filename
            ]);
        } 

    	return back()->with('status', 'Product Inserted Successfully!');
    }

    function deleteproduct($product_id){
    	echo $product_id;
    //	Product::where('id', '=', $product_id)->delete();
    	product::find($product_id)->delete();
    	return back()->with('deleteStatus', 'Product Deleted Successfully');
    }

    function editproduct($product_id){
    	$single_product_info = Product::findOrFail($product_id);
    	return view('product/edit', compact('single_product_info'));
    }
 
    function editproductinsert(Request $request ){
    	if ($request->hasFile('product_image')) {
            if ( Product::find($request->product_id)->product_image == 'default.jpg') {
                $photo_to_upload = $request->product_image;
                $filename = $request->product_id.".".$photo_to_upload->getClientOriginalExtension();// create New File name
                
                //$photo_to_upload->getClientOriginalExtension()----> Get name of file extension
                
                $image = Image::make($photo_to_upload)->resize(400, 450)->save(base_path('public/uploads/product_photos/'.$filename));
                Product::find($request->product_id)->update([
                    'product_image' => $filename
                ]);
            }
            else{
                //first delete the old photo
                $delete_this_file = Product::find($request->product_id)->product_image;
                unlink(base_path('public/uploads/product_photos/'.$delete_this_file));
                //Now upload the new one
                $photo_to_upload = $request->product_image;
                $filename = $request->product_id.".".$photo_to_upload->getClientOriginalExtension();// create New File name
                $image = Image::make($photo_to_upload)->resize(400, 450)->save(base_path('public/uploads/product_photos/'.$filename));
                Product::find($request->product_id)->update([
                    'product_image' => $filename
                ]);
            }
        }
    	Product:: find($request->product_id)->Update([
    		//Table_field_name => Form_field_name
    		'product_name' => $request->product_name,
    		'product_description' => $request->product_description,
    		'product_price' => $request->product_price,
    		'product_quantity' => $request->product_quantity,
    		'alert_quantity' => $request->alert_quantity

    	]);

    	return back()->with('EditStatus', 'Product Edited Successfully');
    }

    function restoreproduct($p_id){

    	Product::onlyTrashed()
        ->where('id', $p_id)
        ->restore();
    	return back();

    }    

    function forcedeleteproduct($p_id){

    	
        $delete_this_file = Product::onlyTrashed()->find($p_id)->product_image;
        unlink(base_path('public/uploads/product_photos/'.$delete_this_file));

        Product::onlyTrashed()->find($p_id)->forceDelete();
    	return back();

    }

}
