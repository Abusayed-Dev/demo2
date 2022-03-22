<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use DB;
use Image;
use File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $category = DB::table('categories')->get();
        return view('admin.category.category.index', compact('category'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories',
            'icon' => 'required',
        ]);

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');
        $data['home_page'] = $request->home_page;

        $slug = Str::slug($request->category_name, '-');

        $photo = $request->icon;
        $photoname = $slug.'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(32, 32)->save('public/files/category/'. $photoname);
        $data['icon'] = 'public/files/category/'. $photoname;

        Category::insert($data);
        $notification = array(
            'messege' => 'Category Insert Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
        
    }


    public function destroy($id)
    {
        $path = DB::table('categories')->where('id', $id)->first();
        if (File::exists($path->icon)) {
                unlink($path->icon);
        }
        DB::table('categories')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Category Delete Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);

    }


    public function edit($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.category.edit', compact('category'));

    }


    public function update(Request $request, $id)
    {

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');
        $data['home_page'] = $request->home_page;

        $slug = Str::slug($request->category_name, '-');

        if ($request->icon) {
            if (File::exists($request->oldicon)) {
                unlink($request->oldicon);
            }

            $photo = $request->icon;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(32, 32)->save('public/files/category/'. $photoname);
            $data['icon'] = 'public/files/category/'. $photoname;

            DB::table('categories')->orderBy('id', 'DESC')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Category Update Successfull',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        } else {
            $data['icon'] = $request->oldicon;
            DB::table('categories')->orderBy('id', 'DESC')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Category Update Successfull',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }

        

    }


}
