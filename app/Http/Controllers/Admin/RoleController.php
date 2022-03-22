<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function index()
    {
        $data = DB::table('users')->where('is_admin', 1)->where('role_admin', 1)->get();
        return view('admin.role.manage_role', compact('data'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
        ]);    

        $data = [];
        $data['name']     = $request->name;
        $data['email']    = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['category'] = $request->category;
        $data['setting']  = $request->setting;
        $data['offer']    = $request->offer;
        $data['pickup']   = $request->pickup;
        $data['product']  = $request->product;
        $data['ticket']   = $request->ticket;
        $data['payment']  = $request->payment;
        $data['order']    = $request->order;
        $data['blog']     = $request->blog;
        $data['contact']  = $request->contact;
        $data['report']   = $request->report;
        $data['user_role']= $request->user_role;
        $data['is_admin'] = 1;
        $data['role_admin']= 1;

        DB::table('users')->insert($data);
        $notification = array(
            'messege' => 'Role Added Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function edit($id)
    {
        $data = DB::table('users')->where('id', $id)->first();
        return view('admin.role.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);    

        $data = [];
        $data['name']     = $request->name;
        $data['email']    = $request->email;
        $data['category'] = $request->category;
        $data['setting']  = $request->setting;
        $data['offer']    = $request->offer;
        $data['pickup']   = $request->pickup;
        $data['product']  = $request->product;
        $data['ticket']   = $request->ticket;
        $data['payment']  = $request->payment;
        $data['order']    = $request->order;
        $data['blog']     = $request->blog;
        $data['contact']  = $request->contact;
        $data['report']   = $request->report;
        $data['user_role']= $request->user_role;

        DB::table('users')->where('id',$id)->update($data);
        $notification = array(
            'messege' => 'Role Updated Successfull',
            'alert-type' => 'success',
        );
        return redirect()->route('manage.role')->with($notification);
    }


    public function destroy($id)
    {
        DB::table('users')->where('id',$id)->delete();
        $notification = array(
            'messege' => 'Role Deleted Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
