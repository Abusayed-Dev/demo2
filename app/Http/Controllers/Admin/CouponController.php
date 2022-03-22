<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;


class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('coupons')->orderBy('id', 'DESC')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('status', function ($row)
                    {
                        if ($row->status == 1) {
                            return '<span class="badge badge-success">Active</span>';
                        }
                    })
                    ->editColumn('type', function ($row)
                    {
                        if ($row->type == 0) {
                            return '<span class="badge badge-success">Fixed</span>';
                        }elseif ($row->type == 1) {
                            return '<span class="badge badge-success">Percentage</span>';
                        }
                    })
                    ->addColumn('action', function ($row){
                       $actionBtn = '<a href="'. route('edit.coupon', [$row->id]) .'" class="btn btn-sm btn-info mr-2 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></a>
                            <a href="'. route('delete.coupon', [$row->id]) .'" id="ajaxdelete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                            </a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action', 'status', 'type'])
                    ->make(true);
        }

        return view('admin.coupon.index');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'coupon_code' => 'required',
            'coupon_amount' => 'required',
            'type' => 'required',
            'valid_date' => 'required',
        ]);

        $data = array();
        $data['coupon_code']   = $request->coupon_code;
        $data['valid_date']    = $request->valid_date;
        $data['type']          = $request->type;
        $data['coupon_amount'] = $request->coupon_amount;
        $data['status']        = $request->status;
        
        DB::table('coupons')->insert($data);
        return response()->json('Coupon Insert Successfull');
    }

    public function edit($id)
    {
        $coupon = DB::table('coupons')->where('id', $id)->first();
        return view('admin.coupon.edit', compact('coupon'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'coupon_code' => 'required',
            'coupon_amount' => 'required',
            'type' => 'required',
            'valid_date' => 'required',
        ]);

        $data = array();
        $data['coupon_code']   = $request->coupon_code;
        $data['valid_date']    = $request->valid_date;
        $data['type']          = $request->type;
        $data['coupon_amount'] = $request->coupon_amount;
        $data['status']        = $request->status;
        
        DB::table('coupons')->where('id', $id)->update($data);
        return response()->json('Coupon Update Successfull');
    }


    public function destroy($id)
    {
        DB::table('coupons')->where('id', $id)->delete();
        return response()->json('Coupon Deleted Successfull');
    }




}
