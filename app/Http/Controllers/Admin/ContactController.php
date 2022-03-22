<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;
use App\Mail\ContactReplyMail;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index()
    {
        $contact = DB::table('contact')->latest()->get();
        return view('admin.contact.index', compact('contact'));
    }


    public function replyMessage($id)
    {
        $contact = DB::table('contact')->where('id', $id)->first();
        return view('admin.contact.edit', compact('contact'));
    }


    public function replyContactMessage(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required',
        ]);

         $data = [];
         $data['contact_id']     = $request->contact_id;
         $data['reply_user_name']= Auth::user()->name;
         $data['message']        = $request->message;

         DB::table('contact')->where('id', $request->contact_id)->update(['status' => 1]);
         $getEmail = DB::table('contact')->where('id', $request->contact_id)->first();

         DB::table('reply_contact')->insert($data);
         
         $reply = DB::table('reply_contact')
                ->leftJoin('contact', 'contact.id', 'reply_contact.contact_id')
                ->where('reply_contact.contact_id', $request->contact_id)
                ->select('contact.name', 'contact.email', 'reply_contact.*')
                ->first();

         Mail::to($getEmail->email)->send(new ContactReplyMail($reply));
         $notification = array(
            'messege' => 'Message Replied.',
            'alert-type' => 'success',
        );
         return redirect()->back()->with($notification);
    }
}
