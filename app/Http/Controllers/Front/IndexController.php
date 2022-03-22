<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\Review;
use Auth;
use App\Models\Category;

class IndexController extends Controller
{
    
    public function index()
    {
    	$category         = DB::table('categories')->get();
    	$pages            = DB::table('pages')->get();
    	$slider_product   = Product::where('slider_product', 'on')->get();
        $brands           = DB::table('brands')->latest()->get();
        $featured_product = Product::where('status', 'on')->where('featured', 'on')->latest()->get();
        $popular_product  = Product::where('status', 'on')->orderBy('product_view', 'DESC')->limit(12)->get();
        $trendy_product   = Product::where('status', 'on')->where('trendy', 'on')->orderBy('id', 'DESC')->limit(6)->get();

        $brand      = DB::table('brands')->latest()->limit(24)->get();
        //Today Deal
        $today_deal = Product::where('status', 'on')->where('today_deal', 'on')->orderBy('id', 'DESC')->limit(4)->get();

        //__website review
        $web_review = DB::table('website_reviews')->where('status', '1')->orderBy('id', 'DESC')->limit(6)->get();
        $campaignOne= DB::table('campaigns')->where('status', '1')->first();
        $campaignTwo= DB::table('campaigns')->where('status', '1')->skip(1)->first();
    	
    	return view('frontend.index', compact('category', 'pages', 'slider_product', 'brands', 'featured_product', 'popular_product', 'trendy_product', 'brand', 'today_deal', 'web_review', 'campaignOne', 'campaignTwo'));
    }

    public function productDetails($slug)
    {
        $category        = DB::table('categories')->get();
    	$singleProduct   = Product::where('slug', $slug)->first();
        $setting         = DB::table('settings')->first();
        $releatedProduct = Product::where('subcategory_id', $singleProduct->subcategory_id)->inRandomOrder()->take(8)->get();
        $pages           = DB::table('pages')->get();
        $reviews         = Review::where('product_id', $singleProduct->id)->orderBy('id', 'DESC')->limit(10)->get();
        $reviewProdcut   = Review::where('product_id', $singleProduct->id)->first();

        Product::where('slug', $slug)->increment('product_view');
    	return view('frontend.product.product_details', compact('category', 'singleProduct', 'setting', 'releatedProduct', 'pages', 'reviews'));
    }


    //__categorywise product
    public function categorywiseProduct($id)
    {
        $category           = DB::table('categories')->get();
        $pages              = DB::table('pages')->get();

        $category_id        = Product::where('id', $id)->first();
        $brandwiseProduct   = Product::where('category_id', $category_id->category->id)->paginate(9);
        
        return view('frontend.categorywise_product', compact('pages', 'brandwiseProduct', 'category_id', 'category'));
    }

    //__nav categorywise product
    public function navCategoryWiseProduct($id)
    {
        $subcategory  = DB::table('subcategories')->where('category_id', $id)->get();
        $catagoris    = DB::table('categories')->where('id', $id)->first();
        $pages        = DB::table('pages')->get();

        $getcategory  = Product::where('category_id', $id)->first();
        $catProduct   = Product::where('category_id', $id)->paginate(9);
        
        return view('frontend.navproduct.navcatwiseproduct', compact('pages', 'catProduct', 'subcategory',  'catagoris', 'getcategory'));
    }


    //__subcategorywise product
    public function subcategoryWiseProduct($id)
    {
        $childcatagory= DB::table('childcategories')->where('subcategory_id', $id)->get();
        $subcatagory  = DB::table('subcategories')->where('id', $id)->first();
        $pages        = DB::table('pages')->get();

        $getsubcategory  = Product::where('subcategory_id', $id)->first();
        $subcatProduct   = Product::where('subcategory_id', $id)->paginate(9);
        
        return view('frontend.navproduct.subcategory_product', compact('childcatagory', 'subcatagory', 'pages', 'subcatProduct',   'getsubcategory'));
    }


    //__childcategorywise product
    public function childcategoryWiseProduct($id)
    {
        $category  = DB::table('categories')->get();
        $childcatagory= DB::table('childcategories')->where('id', $id)->first();
        $pages        = DB::table('pages')->get();

        $getcategory  = Product::where('childcategory_id', $id)->first();
        $catProduct   = Product::where('childcategory_id', $id)->paginate(9);
        
        return view('frontend.navproduct.childcategory_product', compact('pages', 'catProduct', 'category',  'childcatagory', 'getcategory'));
    }

    //__brandwise product
    public function brandwiseProduct($id)
    {
        $category           = DB::table('categories')->get();
        $pages              = DB::table('pages')->get();
        $brandwiseProduct   = Product::where('brand_id', $id)->paginate(9);
        $brands             = Product::where('brand_id', $id)->first();
        
        return view('frontend.brandwise_product', compact('pages', 'brandwiseProduct', 'brands', 'category'));
    }


    //__quickview Product
    public function productQuickView($id)
    {
        $product = Product::where('id', $id)->first();
        return view('frontend.product.product_quickview', compact('product'));
    }


    //__Order Tracking page
    public function orderTrack()
    {
        return view('frontend.order_traking');
    }


    public function checkTrack(Request $request)
    {
        $check = DB::table('orders')->where('order_id', $request->order_id)->first();

        if ($check) {
            $order = DB::table('orders')->where('order_id', $request->order_id)->first();
            $order_details = DB::table('order_details')->where('order_id', $order->id)->get();
            return view('frontend.order_details', compact('order', 'order_details'));
        } else {
            $notification = array('messege' => 'Invalid Order ID', 'alert-type'=> 'error',);
            return redirect()->back()->with($notification); 
        }
    }


    //__contact page 
    public function contactIndex()
    {
        return view('frontend.contact');
    }


}
