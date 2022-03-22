<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use DB;


class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $subcategory = DB::table('subcategories')
                        ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
                        ->select('subcategories.*', 'categories.category_name')
                        ->orderBy('id','DESC')->get();
        return view('admin.category.subcategory.index', compact('subcategory'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => 'required',
        ]);

        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        $data['subcat_slug'] = Str::slug($request->subcategory_name, '-');

        Subcategory::insert($data);
        $notification = array(
            'messege' => 'Subcategory Insert Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
        
    }


    public function edit($id)
    {
        $subcategory = Subcategory::where('id', $id)->first();
        return view('admin.category.subcategory.edit', compact('subcategory'));
    }


    public function update(Request $request, $id)
    {

        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        $data['subcat_slug'] = Str::slug($request->subcategory_name, '-');

        Subcategory::where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Subcategory Update Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);

    }

    public function destroy($id)
    {
        Subcategory::where('id', $id)->delete();
        $notification = array(
            'messege' => 'Subcategory Delete Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }




}
