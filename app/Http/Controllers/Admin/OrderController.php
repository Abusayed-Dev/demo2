<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Mail\ReciveMail;
use Mail;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $order="";
            $data = DB::table('orders')->latest();

                    if ($request->payment_type) {
                        $data->where('payment_type', $request->payment_type);
                    }

                    if ($request->date) {
                         $data->where('date', date('d F , Y', strtotime($request->date)));
                    }

                    if ($request->status == 0) {
                        $data->where('status', 0);
                    } elseif ($request->status == 1) {
                        $data->where('status', 1);
                    } elseif ($request->status == 2) {
                        $data->where('status', 2);
                    } elseif ($request->status == 3) {
                        $data->where('status', 3);
                    } elseif ($request->status == 4) {
                        $data->where('status', 4);
                    } elseif ($request->status == 5) {
                        $data->where('status', 5);
                    }

                   $order = $data->get();

            return DataTables::of($order)
                    ->addIndexColumn()

                    ->editColumn('status', function ($row)
                    {
                        if ($row->status == 0) {
                            return '<span class="badge badge-danger">Pending</span>';
                        } elseif ($row->status == 1) {
                            return '<span class="badge badge-info">Recived</span>';
                        } elseif ($row->status == 2) {
                            return '<span class="badge badge-primary">Shipped</span>';
                        } elseif ($row->status == 3) {
                            return '<span class="badge badge-success">Complited</span>';
                        } elseif ($row->status == 4) {
                            return '<span class="badge badge-warning">Retrun</span>';
                        } elseif ($row->status == 5) {
                            return '<span class="badge badge-danger">Cancel</span>';
                        }
                    })

                    ->addColumn('action', function ($row){
                       $actionBtn = '<a href="'. route('view.order', [$row->id]) .'" class="btn btn-sm btn-info mr-2 view" data-toggle="modal" data-target="#viewModal"><i class="fa fa-eye"></i></a>

                            <a href="'. route('edit.order', [$row->id]) .'" class="btn btn-sm btn-primary mr-2 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></a>

                            <a href="'. route('delete.order', [$row->id]) .'" id="ajaxdelete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                            </a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
        }

        return view('admin.order.index');
    }


    //__view order
    public function viewOrder($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();
        $order_details = DB::table('order_details')->where('order_id', $id)->get();
        return view('admin.order.view', compact('order', 'order_details'));
    }


    public function editOrder($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();
        return view('admin.order.edit', compact('order'));
    }

    //__order status update
    public function updateOrderStatus(Request $request, $id)
    {
        $order = [];
        $order['name'] = $request->name;
        $order['shipping_address'] = $request->shipping_address;
        $order['status'] = $request->status;

        if ($request->status == 1) {
            Mail::to($request->email)->send(new ReciveMail($order));
        }
        
        DB::table('orders')->where('id', $id)->update($order);
        return response()->json('Status Updated.');
    }

    //Order Delete
    public function destroy($id)
    {
        $order = DB::table('orders')->where('id', $id)->delete();
        $order_details = DB::table('order_details')->where('order_id', $id)->delete();
        return response()->json('Order Deleted.');
    }

}
