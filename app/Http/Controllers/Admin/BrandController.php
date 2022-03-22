<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use DB;
use DataTables;
use Image;
use File;


class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('brands')->orderBy('id', 'DESC')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('front_page', function ($row)
                    {
                        if ($row->front_page == 1) {
                            return '<span class="badge badge-success">Homepage</span>';
                        }
                    })
                    ->addColumn('action', function ($row){
                       $actionBtn = '<a href="'. route('edit.brand', [$row->id]) .'" class="btn btn-sm btn-info mr-2 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></a>
                            <a href="'. route('delete.brand', [$row->id]) .'" id="delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                            </a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action', 'front_page'])
                    ->make(true);
        }

        return view('admin.category.brand.index');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands',
            'brand_logo' => 'required',
        ]);

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');
        $data['front_page'] = $request->front_page;

        $slug = Str::slug($request->brand_name, '-');

        $photo = $request->brand_logo;
        $photoname = $slug.'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(100, 30)->save('public/files/brand/'. $photoname);
        $data['brand_logo'] = 'public/files/brand/'. $photoname;

        Brand::insert($data);
        $notification = array(
            'messege' => 'Brand Insert Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'brand_name' => 'required',
        ]);

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');
        $data['front_page'] = $request->front_page;

        $slug = Str::slug($request->brand_name, '-');

        if ($request->brand_logo) {
            if (File::exists($request->old_logo)) {
                unlink($request->old_logo);
            }

            $photo = $request->brand_logo;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(100, 30)->save('public/files/brand/'. $photoname);
            $data['brand_logo'] = "public/files/brand/".$photoname;

            Brand::where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Brand Updated Successfull',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);

        } else {
            $data['brand_logo'] = $request->old_logo;

            Brand::where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Brand Updated Successfull',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
        
    }


    public function destroy($id)
    {
        $path = DB::table('brands')->where('id', $id)->first();
        unlink($path->brand_logo);

        Brand::where('id', $id)->delete();
        $notification = array(
            'messege' => 'Brand Delete Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function edit($id)
    {
        $data = DB::table('brands')->where('id', $id)->first();
        return view('admin.category.brand.edit', compact('data'));
    }




}
