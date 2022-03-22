<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;


class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function orderReport(Request $request)
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
                    ->rawColumns(['status'])
                    ->make(true);
        }

        return view('admin.report.order_report.index');
    }


    //__Order report print method
    public function orderPrint(Request $request)
    {
        if ($request->ajax()) {
            $order="";
            $data = DB::table('orders');

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
        }

        return view('admin.report.order_report.print_report', compact('order'));
    }
}
