<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function paymentGateway()
    {
        $aamarPay = DB::table('payment_gateway')->first();
        $surjoPay = DB::table('payment_gateway')->skip(1)->first();
        $ssl      = DB::table('payment_gateway')->skip(2)->first();
        return view('admin.payment_gateway.edit', compact('aamarPay', 'surjoPay', 'ssl'));
    }


    public function updateAamarpay(Request $request, $id)
    {
        $data = [];
        $data['store_id'] = $request->store_id;
        $data['signature_key'] = $request->signature_key;
        $data['status'] = $request->status;

        DB::table('payment_gateway')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Aamarpay Updated Successfull.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function updateSurjopay(Request $request, $id)
    {
        $data = [];
        $data['store_id'] = $request->store_id;
        $data['signature_key'] = $request->signature_key;
        $data['status'] = $request->status;

        DB::table('payment_gateway')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Updated Surjopay.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function updateSSL(Request $request, $id)
    {
        $data = [];
        $data['store_id'] = $request->store_id;
        $data['signature_key'] = $request->signature_key;
        $data['status'] = $request->status;

        DB::table('payment_gateway')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Updated SSL Commerz.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
