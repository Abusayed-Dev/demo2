<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PageController extends Controller
{
    public function pageView($page_slug)
    {
        $page = DB::table('pages')->where('page_slug', $page_slug)->first();
        return view('frontend.page', compact('page'));
    }


    //__Store newsletter
    public function storeNewsleter(Request $request)
    {
        $check = DB::table('newsletter')->where('email', $request->email)->first();
        if ($check) {
            return response()->json('Email already exists!');
        }

        DB::table('newsletter')->insert(['email' => $request->email]);
        return response()->json('Thanks for your Subscription');
    }


    //___________ blogs details method _____________//
    public function blogCatDetails($id)
    {
        $pages   = DB::table('pages')->get();
        $blogCat = DB::table('blog_categories')->where('id', $id)->first();
        $blog    = DB::table('blog')->where('blog_category_id', $id)->paginate(5);
        return view('frontend.blog.blog_details', compact('pages', 'blogCat', 'blog'));
    }
}
