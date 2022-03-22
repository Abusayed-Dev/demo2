<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

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
        if (!Auth::user()->is_admin == 1) {
            $order = DB::table('orders')->where('user_id', Auth::id())->latest()->take(10)->get();

            //__Order Count
            $total_order    = DB::table('orders')->where('user_id', Auth::id())->count();
            $complete_order = DB::table('orders')->where('user_id', Auth::id())->where('status', 1)->count();
            $return_order   = DB::table('orders')->where('user_id', Auth::id())->where('status', 4)->count();
            $cancel_order   = DB::table('orders')->where('user_id', Auth::id())->where('status', 5)->count();

            return view('home', compact('order', 'total_order', 'complete_order', 'return_order', 'cancel_order'));
        } else{
            return redirect()->back();
        }
        
    }


    //__customer logout
    public function logout()
    {
        Auth::logout();
        $notification = array(
            'messege' => 'Logout Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
