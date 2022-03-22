<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;
use Cart;
use Session;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if (!Auth::check()) {
            $notification = array('messege' => 'Your Password Changed', 'alert-type'=> 'error',);
            return redirect()->back()->with($notification);
        }

        $pages   = DB::table('pages')->get();
        return view('frontend.cart.checkout', compact('pages'));
    }


    //__coupon apply
    public function applyCoupon(Request $request)
    {
        $coupon = DB::table('coupons')->where('coupon_code', $request->coupon_code)->first();
        if ($coupon) {

            if (date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($coupon->valid_date))) {
                Session::put('coupon', [
                    'name' => $coupon->coupon_code,
                    'discount_price' => $coupon->coupon_amount,
                    'after_discount' => Cart::subtotal()-$coupon->coupon_amount,
                ]);

                $notification = array('messege' => 'Coupon Aplied', 'alert-type'=> 'success',);
                return redirect()->back()->with($notification); 
            } else {
                $notification = array('messege' => 'Expired Coupon!', 'alert-type'=> 'error',);
                return redirect()->back()->with($notification); 
            }
            
        }else{
             $notification = array('messege' => 'Invalid Coupon Code!', 'alert-type'=> 'error',);
             return redirect()->back()->with($notification); 
        }
    }

    //__remove coupon
    public function removeCoupon()
    {
        Session::forget('coupon');
        $notification = array('messege' => 'Coupon Removed', 'alert-type'=> 'success',);
        return redirect()->back()->with($notification); 
    }


    //__order place
    public function orderPlace(Request $request)
    {

        if ($request->payment_type == 'Hand Cash') {
            $order = [];
            $order['user_id'] = Auth::id();
            $order['name']    = $request->name;
            $order['phone']   = $request->phone;
            $order['email']   = $request->email;
            $order['shipping_address'] = $request->shipping_address;
            $order['country'] = $request->country;
            $order['zip_code']= $request->zip_code;
            $order['city']    = $request->city;
            $order['extra_phone']      = $request->extra_phone;

            if (Session::has('coupon')) {
                $order['subtotal']       = Cart::subtotal();
                $order['total']          = Cart::total();
                $order['coupon_code']    = Session::get('coupon')['name'];
                $order['coupon_discount']= Session::get('coupon')['discount_price'];
                $order['after_discount'] = Session::get('coupon')['after_discount'];
            }

            $order['subtotal'] = Cart::subtotal();
            $order['total']    = Cart::total();
            $order['date']     = date('d F , Y');
            $order['month']    = date('F');
            $order['year']     = date('Y');

            $order['payment_type']   = $request->payment_type;
            $order['tax']            = 0;
            $order['shipping_charge']= 0;
            $order['order_id']       = rand(100000, 999999);
            $order['status']         = 0;

            $order_id = DB::table('orders')->insertGetId($order);
            Mail::to($request->email)->send(new InvoiceMail($order));


            //__Order Details
            $content = Cart::content();

            $details = [];
            foreach ($content as $value) {        
                $details['order_id']      = $order_id;
                $details['product_id']    = $value->id;
                $details['product_name']  = $value->name;
                $details['color']         = $value->options->color;
                $details['size']          = $value->options->size;
                $details['quantity']      = $value->qty;
                $details['single_price']  = $value->price;
                $details['subtotal_price']= $value->price*$value->qty;

                DB::table('order_details')->insert($details);
            }

            Cart::destroy();
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }
            $notification = array('messege' => 'Successfully order placed', 'alert-type'=> 'success',);
            return redirect()->to('/')->with($notification);

        } elseif($request->payment_type == 'Aamarpay') {

            $aamarPay = DB::table('payment_gateway')->first();
            if ($aamarPay->store_id) {
                if ($aamarPay->status == 1) {
                    $url = 'https://secure.aamarpay.com/request.php'; // live url https://secure.aamarpay.com/
                } else {
                    $url = 'https://sandbox.aamarpay.com/request.php'; // live url https://secure.aamarpay.com/request.php
                }
               
                $fields = array(
                    'store_id' => $aamarPay->store_id, //store id will be aamarpay,  contact integration@aamarpay.com for test/live id
                    'amount' => Cart::total(), //transaction amount
                    'payment_type' => 'VISA', //no need to change
                    'currency' => 'BDT',  //currenct will be USD/BDT
                    'tran_id' => rand(1111111,9999999), //transaction id must be unique from your end
                    'cus_name' => $request->name,  //customer name
                    'cus_email' => $request->email, //customer email address
                    'cus_add1' => 'Dhaka',  //customer address
                    'cus_add2' => 'Mohakhali DOHS', //customer address
                    'cus_city' => $request->city,  //customer city
                    'cus_state' => 'Dhaka',  //state
                    'cus_postcode' => $request->zip_code, //postcode or zipcode
                    'cus_country' => $request->country,  //country
                    'cus_phone' => $request->phone, //customer phone number
                    'cus_fax' => 'Not¬Applicable',  //fax
                    'ship_name' => $request->extra_phone, //ship name
                    'ship_add1' => $request->shipping_address,  //ship address
                    'ship_add2' => $request->shipping_address,
                    'ship_city' => $request->city, 
                    'ship_state' => 'Dhaka',
                    'ship_postcode' => $request->zip_code, 
                    'ship_country' => $request->country,
                    'desc' => 'payment description', 
                    'success_url' => route('success'), //your success route
                    'fail_url' => route('fail'), //your fail route
                    'cancel_url' => route('cancel'), //your cancel url
                    'opt_a' => $request->country,  //optional paramter
                    'opt_b' => $request->city,
                    'opt_c' => $request->phone, 
                    'opt_d' => $request->shipping_address,
                    'signature_key' => $aamarPay->signature_key); //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key

                    $fields_string = http_build_query($fields);
             
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_VERBOSE, true);
                curl_setopt($ch, CURLOPT_URL, $url);  
          
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));  
                curl_close($ch); 

                $this->redirect_to_merchant($url_forward);
                
            } else {
                $notification = array('messege' => 'Aamarpay Store Id Null!', 'alert-type'=> 'error',);
                return redirect()->back()->with($notification); 
            }
            
        }

    }

    function redirect_to_merchant($url) {

        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
          <head><script type="text/javascript">
            function closethisasap() { document.forms["redirectpost"].submit(); } 
          </script></head>
          <body onLoad="closethisasap();">
          
            <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
            <!-- for live url https://secure.aamarpay.com -->
          </body>
        </html>
        <?php   
        exit;
    } 

    
    public function success(Request $request){
        $order = [];
        $order['user_id'] = Auth::id();
        $order['name']    = $request->cus_name;
        $order['phone']   = $request->cus_phone;
        $order['email']   = $request->cus_email;
        $order['shipping_address'] = $request->opt_d;
        $order['country'] = $request->cus_country;
        $order['zip_code']= $request->cus_postcode;
        $order['city']    = $request->cus_city;
        $order['extra_phone'] = $request->ship_name;

        if (Session::has('coupon')) {
            $order['subtotal']       = Cart::subtotal();
            $order['total']          = Cart::total();
            $order['coupon_code']    = Session::get('coupon')['name'];
            $order['coupon_discount']= Session::get('coupon')['discount_price'];
            $order['after_discount'] = Session::get('coupon')['after_discount'];
        }

        $order['subtotal'] = Cart::subtotal();
        $order['total']    = Cart::total();
        $order['date']     = date('d F , Y');
        $order['month']    = date('F');
        $order['year']     = date('Y');

        $order['payment_type']   = 'Aamarpay';
        $order['tax']            = 0;
        $order['shipping_charge']= 0;
        $order['order_id']       = rand(100000, 999999);
        $order['status']         = 1;

        $order_id = DB::table('orders')->insertGetId($order);
        Mail::to(Auth::user()->email)->send(new InvoiceMail($order));


        //__Order Details
        $content = Cart::content();

        $details = [];
        foreach ($content as $value) {        
            $details['order_id']      = $order_id;
            $details['product_id']    = $value->id;
            $details['product_name']  = $value->name;
            $details['color']         = $value->options->color;
            $details['size']          = $value->options->size;
            $details['quantity']      = $value->qty;
            $details['single_price']  = $value->price;
            $details['subtotal_price']= $value->price*$value->qty;

            DB::table('order_details')->insert($details);
        }

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notification = array('messege' => 'Successfully order placed', 'alert-type'=> 'success',);
        return redirect()->route('home')->with($notification);
    }

    public function fail(Request $request){
        return $request;
    }

}
