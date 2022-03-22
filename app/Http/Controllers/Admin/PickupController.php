<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;


class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('pickup_points')->orderBy('id', 'DESC')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row){
                       $actionBtn = '<a href="'. route('edit.pickup_point', [$row->id]) .'" class="btn btn-sm btn-info mr-2 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></a>
                            <a href="'. route('delete.pickup_point', [$row->id]) .'" id="delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                            </a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.pickup_point.index');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'pickup_point_name' => 'required',
            'pickup_point_address' => 'required',
            'pickup_phone' => 'required',
        ]);

        $data = array();
        $data['pickup_point_name']    = $request->pickup_point_name;
        $data['pickup_point_address'] = $request->pickup_point_address;
        $data['pickup_phone']         = $request->pickup_phone;
        $data['pickup_phone_two']     = $request->pickup_phone_two;
        
        DB::table('pickup_points')->insert($data);
        $notification = array(
            'messege' => 'Pickup Point Insert Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pickup_point_name' => 'required',
            'pickup_point_address' => 'required',
            'pickup_phone' => 'required',
        ]);

        $data = array();
        $data['pickup_point_name']    = $request->pickup_point_name;
        $data['pickup_point_address'] = $request->pickup_point_address;
        $data['pickup_phone']         = $request->pickup_phone;
        $data['pickup_phone_two']     = $request->pickup_phone_two;
        
        DB::table('pickup_points')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Pickup Point Update Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function edit($id)
    {
        $pickuppoint = DB::table('pickup_points')->where('id', $id)->first();
        return view('admin.pickup_point.edit', compact('pickuppoint'));
    }

    public function destroy($id)
    {
        DB::table('pickup_points')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Pickup Point Delete Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }







}
