<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Childcategory;
use Illuminate\Support\Str;
use DB;
use DataTables;

class ChildcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('childcategories')
                    ->leftJoin('categories', 'childcategories.category_id', 'categories.id')
                    ->leftJoin('subcategories', 'childcategories.subcategory_id', 'subcategories.id')
                    ->select('categories.category_name', 'subcategories.subcategory_name', 'childcategories.*')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row){
                       $actionBtn = '<a href="'. route('edit.childcategory', [$row->id]) .'" class="btn btn-sm btn-info mr-2 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></a>
                            <a href="'. route('delete.childcategory', [$row->id]) .'" id="delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                            </a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $category = DB::table('categories')->get();
        return view('admin.category.childcategory.index', compact('category'));
    }


    public function store(Request $request)
    {
        $subcategory = DB::table('subcategories')->where('id', $request->subcategory_id)->first();

        $validated = $request->validate([
            'childcategory_name' => 'required',
        ]);

        $data = array();
        $data['category_id'] = $subcategory->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_name'] = $request->childcategory_name;
        $data['childcategory_slug'] = Str::slug($request->childcategory_name, '-');

        Childcategory::insert($data);
        $notification = array(
            'messege' => 'Childcategory Insert Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
        
    }


    public function destroy($id)
    {
        Childcategory::where('id', $id)->delete();
        $notification = array(
            'messege' => 'Childcategory Insert Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function edit($id)
    {
        $category = DB::table('categories')->get();
        $data = DB::table('childcategories')->where('id', $id)->first();
        return view('admin.category.childcategory.edit', compact('data', 'category'));
    }


    public function update(Request $request, $id)
    {
        $subcategory = DB::table('subcategories')->where('id', $request->subcategory_id)->first();

        $validated = $request->validate([
            'childcategory_name' => 'required',
        ]);

        $data = array();
        $data['category_id'] = $subcategory->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_name'] = $request->childcategory_name;
        $data['childcategory_slug'] = Str::slug($request->childcategory_name, '-');

        Childcategory::where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Childcategory Update Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }



}
