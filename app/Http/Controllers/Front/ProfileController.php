<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use App\Models\User;
use Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function setting()
    {
        return view('frontend.user.setting');
    }


    public function passwordChange(Request $request)
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
            $notification = array('messege' => 'Your Password Changed', 'alert-type'=> 'success',);
            return redirect()->to('/')->with($notification); 
        } else {
            $notification = array('messege' => 'Old Password not matached!', 'alert-type'=> 'error',);
            return redirect()->back()->with($notification); 
        }
    }


    public function Orders()
    {
        $order = DB::table('orders')->where('user_id', Auth::id())->latest()->get();
        return view('frontend.user.order', compact('order'));
    }


    //__Tickets
    public function Tickets()
    {
        $ticket = DB::table('tickets')->where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('frontend.user.ticket.ticket', compact('ticket'));
    }

    public function newTicket()
    {
        return view('frontend.user.ticket.new_ticket');
    }

    public function storeTicket(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required',
            'priority'=> 'required',
            'service' => 'required',
            'message' => 'required',
        ]);

        $ticket = [];
        $ticket['user_id'] = Auth::id();
        $ticket['subject'] = $request->subject;
        $ticket['service'] = $request->service;
        $ticket['priority']= $request->priority;
        $ticket['message'] = $request->message;
        $ticket['status']  = 0;
        $ticket['date']    = date('d-m-Y');
        
        if ($request->image) {
            $image = $request->image;
            $photoname = uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(350, 160)->save('public/files/tickets/'. $photoname);
            $ticket['image'] = 'public/files/tickets/'. $photoname;
        }
        
        DB::table('tickets')->insert($ticket);
        $notification = array('messege' => 'Ticket Sent Successfully.', 'alert-type'=> 'success',);
        return redirect()->route('open.ticket')->with($notification); 
    }


    public function showTicket($id)
    {
         $ticket = DB::table('tickets')->where('id', $id)->first();
         return view('frontend.user.ticket.show_ticket', compact('ticket'));
    }


    //__reply ticket
    public function replyTicket(Request $request, $id)
    {
        $validated = $request->validate([
            'message' => 'required',
        ]);

        $reply = [];
        $reply['user_id']  = Auth::id();
        $reply['ticket_id']= $id;
        $reply['message']  = $request->message;
        $reply['date']     = date('d-m-Y');
        
        if ($request->image) {
            $image = $request->image;
            $photoname = uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(350, 160)->save('public/files/tickets/'. $photoname);
            $reply['image'] = 'public/files/tickets/'. $photoname;
        }
        
        DB::table('replies')->insert($reply);
        $notification = array('messege' => 'Ticket Replied.', 'alert-type'=> 'success',);
        return redirect()->back()->with($notification);
    }


    //__order details
    public function orderDetails($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();
        $order_details = DB::table('order_details')->where('order_id', $id)->get();
        return view('frontend.user.order_details', compact('order', 'order_details'));
    }
}
