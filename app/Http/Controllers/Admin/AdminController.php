<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        return view('admin.home');
    }

    public function logout()
    {
        Auth::logout();
        $notification = array(
            'messege' => 'Logout Successfull',
            'alert-type'=> 'success',
        );
        return redirect()->route('admin.login')->with($notification);
    }


    public function passwordChange()
    {
        return view('admin.password_change');
    }


    //__chnage password
    public function passwordUpdate(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $old_pass     = $request->old_password;
        $current_pass = Auth::user()->password;

        $new_password = $request->password;

        if (Hash::check($old_pass, $current_pass)) {
            
            $user= User::findorfail(Auth::id());
            $user->password = Hash::make($new_password);
            $user->save();
            Auth::logout();
            $notification = array('messege' => 'Password Changed Successfull', 'alert-type'=> 'success',);
            return redirect()->route('admin.login')->with($notification); 
        } else {
            $notification = array('messege' => 'Old Password not matached!', 'alert-type'=> 'error',);
            return redirect()->back()->with($notification); 
        }
    }
}
