<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use App\Category;


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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $All_User =  User::all();
        return view('home', compact('All_User'));


    } 

    public function contactmessageview()
    {
       $contactmessages = Contact::all();
        
       return view('contact.view', compact('contactmessages'));


    } 

    public function changemenustatus($category_id)
    {
       
       // Method 1 for change menu status

       // if (Category::find($category_id)->menu_status == 0) {
       //      Category::find($category_id)->update([
       //          'menu_status' => true
       //      ]);
       // }

       // else{
       //       Category::find($category_id)->update([
       //          'menu_status' => false
       //      ]);
       // }

       //Method 2 for Change menu status 

        $category_info = Category::find($category_id);
        if ( $category_info->menu_status == 0) {
            $category_info->menu_status = true;
        }
        else {
            $category_info->menu_status = false;
        }

        $category_info->save();   

        // Method 2 END


       return back();


    }

    function readcontactmessage( $contact_id ){

      $status = Contact::find($contact_id);

      if ( $status->read_status == 1 ) {
          
          $status->read_status = 2;

       }
       else{

          $status->read_status = 1;

       }

       $status -> save();
 
       return back();

    }


}
