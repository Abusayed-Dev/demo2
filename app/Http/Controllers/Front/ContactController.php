<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class ContactController extends Controller
{
    public function store(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

         $data = [];
         $data['name']   = $request->name;
         $data['email']  = $request->email;
         $data['phone']  = $request->phone;
         $data['subject']= $request->subject;
         $data['message']= $request->message;
         $data['status'] = 0;

         DB::table('contact')->insert($data);
         return response()->json('Message Sent');

    }
}
