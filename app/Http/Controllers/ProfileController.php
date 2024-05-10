<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }

   public function index(){
         
           return view('profile.profile'); 
      
   }

   public function profileEdit(Request $request){
         
          // Get the authenticated user
        $user = Auth::user();

        // Update user profile fields
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->email = $request->input('email');
        $user->specialization = $request->input('specialization');

        // Save the changes
        $user->save();

        // Redirect the user or return a response as needed
        return redirect()->back();
      
   }


}
