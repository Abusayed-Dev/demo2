<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
use DB;
use Auth;



class CartController extends Controller
{
    public function addToCartQuickView(Request $request, $id)
    {
        if (Auth::check()) {
            $product = DB::table('products')->where('id', $id)->first();

            Cart::add([
              'id' => $id,
              'name' => $product->name,
              'qty' => $request->qty,
              'price' => $request->price,
              'weight' => 1,
              'options' => ['size' => $request->size, 'color' => $request->color, 'thumbnail' => $product->thumbnail]
              
            ]);

            return response()->json('Added Successfully');
        } else {
            return response()->json('Please at first login your account! then cart added to Try');
        }
    }


    public function allCart()
    {
        $data = array();
        $data['cart_qty']   = Cart::count();
        $data['cart_total'] = Cart::total();
        $data['content'] = Cart::content();

        return response()->json($data);
    }

    //__add whislist
    public function addWhislist($id)
    {
        if (Auth::check()) {
            $check = DB::table('whislists')->where('user_id', Auth::id())->where('product_id', $id)->first();
            if ( $check) {
                $notification = array(
                    'messege' => 'Already you have added whislist this product!',
                    'alert-type' => 'error',
                );
                return redirect()->back()->with($notification);
            }

            $data = array();
            $data['user_id']    = Auth::id();
            $data['date']       = date('d F , Y');
            $data['product_id'] = $id;

            DB::table('whislists')->insert($data);
            $notification = array(
                'messege' => 'Product added on your whislist',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'messege' => 'At first login your account! then try to added whislist ',
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }


    //Clear Total whislist
    public function clearWhislist()
    {
        DB::table('whislists')->where('user_id', Auth::id())->delete();
        $notification = array(
            'messege' => 'Your Whislist Now Cleared!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function viewCart()
    {
        $category    = DB::table('categories')->get();
        $pages       = DB::table('pages')->get();

        $all_content = Cart::content();
        return view('frontend.cart.cart_view', compact('all_content', 'category', 'pages'));
    }


    public function removeRow($rowId)
    {
        Cart::remove($rowId);
        $notification = array(
            'messege' => 'Cart Row Removed Successfully ',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    //__color update
    public function UpdateColor($rowId, $color)
    {
        $product = Cart::get($rowId);
        $thumbnail = $product->options->thumbnail;
        $size      = $product->options->size;

        Cart::update($rowId, ['options'  => ['color' => $color, 'size' => $size, 'thumbnail' => $thumbnail]]); 
        return response()->json('Colored Update Success');
    }

    //__qty update
    public function UpdateQty($rowId, $qty)
    {
        Cart::update($rowId, ['qty' => $qty]); 
        return response()->json('Quantity Update Success');
    }


    //Destroy Cart
    public function destroyCart()
    {
        Cart::destroy();
        $notification = array(
            'messege' => 'Your Cart Cleared. ',
            'alert-type' => 'success',
        );
        return redirect()->to('/')->with($notification);
    }
}
