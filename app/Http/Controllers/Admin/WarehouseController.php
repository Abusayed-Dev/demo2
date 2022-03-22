<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use DataTables;



class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('warehouses')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row){
                       $actionBtn = '<a href="'. route('edit.warehouse', [$row->id]) .'" class="btn btn-sm btn-info mr-2 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></a>
                            <a href="'. route('delete.warehouse', [$row->id]) .'" id="deleteID" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                            </a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.category.warehouse.index');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'warehouse_name' => 'required',
            'warehouse_address' => 'required',
            'warehouse_phone' => 'required',
        ]);

        $data = array();
        $data['warehouse_name']    = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_phone']   = $request->warehouse_phone;

        DB::table('warehouses')->insert($data);

        return response()->json('Data Insert Successfully');
        
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'warehouse_name' => 'required',
            'warehouse_address' => 'required',
            'warehouse_phone' => 'required',
        ]);

        $data = array();
        $data['warehouse_name']    = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_phone']   = $request->warehouse_phone;

        DB::table('warehouses')->where('id', $id)->update($data);

        return response()->json('Data Update Successfully');
        
    }


    public function destroy($id)
    {
        DB::table('warehouses')->where('id', $id)->delete();
        return response()->json('Data Delete Successfully');
    }


    public function edit($id)
    {
        $data = DB::table('warehouses')->where('id', $id)->first();
        return view('admin.category.warehouse.edit', compact('data'));
    }






}
