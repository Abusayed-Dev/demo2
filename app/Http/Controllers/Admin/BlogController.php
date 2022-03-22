<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Str;
use Image;
use File;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $category = DB::table('blog_categories')->latest()->get();
        return view('admin.blogs.category.index', compact('category'));
    }


    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required',
        ]);

        $data = [];
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');
        
        DB::table('blog_categories')->insert($data);
        $notification = array(
            'messege' => 'Data Insert Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function editCategory($id)
    {
        $category = DB::table('blog_categories')->where('id', $id)->first();
        return view('admin.blogs.category.edit', compact('category'));
    }


    public function updateCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'category_name' => 'required',
        ]);

        $data = [];
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');
        
        DB::table('blog_categories')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Data Updated Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function destroyCategory($id)
    {
        DB::table('blog_categories')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Data Deleted Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    //--------- Blog Details ----------//

    public function blogIndex()
    {
        $category = DB::table('blog_categories')->get();
        $blog     = DB::table('blog')
                    ->leftJoin('blog_categories', 'blog_categories.id', 'blog.blog_category_id')
                    ->latest()->select('blog.*', 'blog_categories.category_name')->get();
        return view('admin.blogs.blog.index', compact('category', 'blog'));
    }


    public function storeBlog(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'thumbnail' => 'required',
            'status' => 'required',
        ]);

        $data = [];
        $data['blog_category_id'] = $request->blog_category_id;
        $data['title']            = $request->title;
        $data['slug']             = Str::slug($request->title, '-');
        $data['publish_date']             = date('d F , Y');
        $data['description']      = $request->description;
        $data['tag']              = $request->tag;
        $data['status']           = $request->status;

        $slug = Str::slug($request->title, '-');
        if ($request->thumbnail) {

            $photo = $request->thumbnail;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(1200, 450)->save('public/files/blog/'. $photoname);
            $data['thumbnail'] = 'public/files/blog/'. $photoname;
        }
        
        DB::table('blog')->insert($data);
        $notification = array(
            'messege' => 'Data Insert Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function editBlog($id)
    {
        $category = DB::table('blog_categories')->get();
        $blog     = DB::table('blog')->where('id', $id)->first();
        return view('admin.blogs.blog.edit', compact('category', 'blog'));
    }


    public function destroyBlog($id)
    {
        $blog = DB::table('blog')->where('id', $id)->first();
        if ($blog->thumbnail) {
            unlink($blog->thumbnail);
        }

        DB::table('blog')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Blog Deleted Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function updateBlog(Request $request, $id)
    {

        $data = [];
        $data['blog_category_id'] = $request->blog_category_id;
        $data['title']            = $request->title;
        $data['slug']             = Str::slug($request->title, '-');
        $data['description']      = $request->description;
        $data['tag']              = $request->tag;
        $data['status']           = $request->status;

        $slug = Str::slug($request->title, '-');
        if ($request->thumbnail) {

            if (File::exists($request->old_thumbnail)) {
                unlink($request->old_thumbnail);
            }

            $photo = $request->thumbnail;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(1200, 450)->save('public/files/blog/'. $photoname);
            $data['thumbnail'] = 'public/files/blog/'. $photoname;

            DB::table('blog')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Blog Updated Successfull',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);

        } else{
            $data['thumbnail'] = $request->old_thumbnail;
            DB::table('blog')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Blog Updated Successfull',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }
}
