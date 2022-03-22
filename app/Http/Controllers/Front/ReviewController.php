<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;


class ReviewController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function reviewStore(Request $request)
    {
        $validated = $request->validate([
            'review' => 'required',
            'rating' => 'required',
        ]);

        $check = DB::table('reviews')->where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        if ( $check) {
            $notification = array(
                'messege' => 'Already you have reviewd this product!',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }

        $data = array();
        $data['user_id'] = Auth::id();
        $data['product_id'] = $request->product_id;
        $data['review'] = $request->review;
        $data['rating'] = $request->rating;
        $data['review_date']  = date('d-m-Y');
        $data['review_month'] = date('F');
        $data['review_year']  = date('Y');

        DB::table('reviews')->insert($data);
        $notification = array(
            'messege' => 'Thanks for your reviews.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function showWhislist($user_id)
    {
        if (Auth::id() == $user_id) {
            $check = DB::table('whislists')->where('user_id', $user_id)->first();
            if ($check) {
                $category = DB::table('categories')->get();
                $pages    = DB::table('pages')->get();
                $whislist = DB::table('whislists')->leftJoin('products', 'products.id', 'whislists.product_id')
                            ->select('products.name','products.thumbnail', 'products.slug', 'products.discount_price', 'products.selling_price', 'products.discount_price', 'whislists.*')
                            ->where('user_id', $user_id)->get();
                return view('frontend.whislist.index', compact('category', 'pages', 'whislist'));
            } else{
                return redirect()->to('/');
            }
        } else {
            return redirect()->to('/');
        }


    }


    public function destroyWhislist($id)
    {
        $whislist = DB::table('whislists')->where('user_id', Auth::id())->where('id', $id)->delete();
        $notification = array(
            'messege' => 'whislist Delete Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }



    //__write review
    public function writeReview()
    {
        return view('frontend.user.review_write');
    }


    //__web review store
    public function webReviewStore(Request $request)
    {
        $check = DB::table('website_reviews')->where('user_id', Auth::id())->first();

        if ($check) {
            $notification = array(
                'messege' => 'Sorry, You are already reviwed.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        } 
        $data = array();
        $data['user_id']= Auth::id();
        $data['name']   = Auth::user()->name;
        $data['review'] = $request->review;
        $data['rating'] = $request->rating;
        $data['status'] = 0;
        $data['date']   = date('d F , Y');

        DB::table('website_reviews')->insert($data);
        $notification = array(
            'messege' => 'Thanks for your reviwed.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
       
    }

}
