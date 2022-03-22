<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Str;
use Image;
use File;
use Auth;



class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $category    = DB::table('categories')->get();
        $brand       = DB::table('brands')->get();
        $pickuppoint = DB::table('pickup_points')->get();
        $warehouse   = DB::table('warehouses')->get();
        return view('admin.product.create', compact('category', 'brand', 'pickuppoint', 'warehouse'));
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $product="";
            $data = DB::table('products')
                    ->leftJoin('categories', 'categories.id', 'products.category_id')
                    ->leftJoin('subcategories', 'subcategories.id', 'products.subcategory_id')
                    ->leftJoin('brands', 'brands.id', 'products.brand_id');


                    if ($request->category_id) {
                        $data->where('products.category_id', $request->category_id);
                    }

                    if ($request->brand_id) {
                        $data->where('products.brand_id', $request->brand_id);
                    }

                    if ($request->warehouse_id) {
                        $data->where('products.warehouse_id', $request->warehouse_id);
                    }

                    if ($request->status == 'on') {
                        $data->where('products.status', 'on');
                    } 

                    if($request->status == 'off'){
                        $data->where('products.status', 'off');
                    }


                   $product = $data->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')->get();

            return DataTables::of($product)
                    ->addIndexColumn()
                    ->editColumn('thumbnail', function ($row)
                    {
                        return '<img src="'.asset($row->thumbnail).'" height="40" width="60">';
                    })
                    ->editColumn('featured', function ($row)
                    {
                        if ($row->featured == 'on') {
                            return '<a id="activeFeatured" href="'.route('active.featured', [$row->id]).'" class="text-danger">
                                    <i class="fa fa-thumbs-up"></i>
                                    <span class="badge badge-success">Active</span>
                                    </a>';
                        } else {
                            return '<a id="deactiveFeatured" href="'.route('deactive.featured', [$row->id]).'" class="text-success">
                                    <i class="fa fa-thumbs-down"></i>
                                    <span class="badge badge-danger">Deactive</span></a>';
                        }
                    })

                    ->editColumn('today_deal', function ($row)
                    {
                        if ($row->today_deal == 'on') {
                            return '<a id="activeDeal"  href="'.route('active.deal', [$row->id]).'" class="text-danger">
                                    <i class="fa fa-thumbs-down"></i>
                                    <span class="badge badge-success">Active</span></a>';
                        } else {
                            return '<a id="deactiveDeal" href="'.route('deactive.deal', [$row->id]).'" class="text-success">
                                    <i class="fa fa-thumbs-up"></i>
                                    <span class="badge badge-danger">Deactive</span></a>';
                        }
                    })

                    ->editColumn('status', function ($row)
                    {
                        if ($row->status == 'on') {
                            return '<a id="activeStatus"  href="'.route('active.status', [$row->id]).'" class="text-danger">
                                    <i class="fa fa-thumbs-down"></i>
                                    <span class="badge badge-success">Active</span></a>';
                        } else {
                            return '<a id="deactiveStatus"  href="'.route('deactive.status', [$row->id]).'" class="text-success">
                                    <i class="fa fa-thumbs-up"></i>
                                    <span class="badge badge-danger">Deactive</span></a>';
                        }
                    })

                    ->addColumn('action', function ($row){
                       $actionBtn = '<a href="'. route('edit.product', [$row->id]) .'" class="btn btn-sm btn-info mr-2 edit"><i class="fa fa-edit"></i></a>
                            <a href="'. route('delete.product', [$row->id]) .'" id="ajaxdelete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                            </a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action', 'thumbnail', 'featured', 'today_deal', 'status'])
                    ->make(true);
        }

        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $warehouse = DB::table('warehouses')->get();

        return view('admin.product.index', compact('category', 'brand', 'warehouse'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products|max:55',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'pickup_point_id' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'thumbnail' => 'required',
            'description' => 'required',
        ]);

        $subcategory = DB::table('subcategories')->where('id', $request->subcategory_id)->first();

        $data = array();
        $data['name']             = $request->name;
        $data['slug']             = Str::slug($request->name, '-');
        $data['category_id']      = $subcategory->category_id;
        $data['subcategory_id']   = $request->subcategory_id;
        $data['childcategory_id'] = $request->childcategory_id;
        $data['brand_id']         = $request->brand_id;
        $data['admin_id']         = Auth::id();
        $data['unit']             = $request->unit;
        $data['code']             = $request->code;
        $data['tags']             = $request->tags;
        $data['pickup_point_id']  = $request->pickup_point_id;
        $data['purchage_price']   = $request->purchage_price;
        $data['selling_price']    = $request->selling_price;
        $data['discount_price']   = $request->discount_price;
        $data['stock_quantity']   = $request->stock_quantity;
        $data['warehouse_id']     = $request->warehouse_id;
        $data['color']            = $request->color;
        $data['size']             = $request->size;
        $data['description']      = $request->description;
        $data['video']            = $request->video;
        $data['featured']         = $request->featured;
        $data['today_deal']       = $request->today_deal;
        $data['trendy']           = $request->trendy;
        $data['slider_product']   = $request->slider_product;
        $data['status']           = $request->status;
        $data['date']             = date('d-m-Y');
        $data['month']            = date('F');



        $slug = Str::slug($request->name, '-');

        $photo = $request->thumbnail;
        $photoname = $slug.'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(600, 600)->save('public/files/product/'. $photoname);
        $data['thumbnail'] = 'public/files/product/'. $photoname;

        // multiple image upload
        $images = array();
        if($request->hasFile('images')){
           foreach ($request->file('images') as $key => $image) {
               $imageName= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
               Image::make($image)->resize(600,600)->save('public/files/product/'.$imageName);
               array_push($images, $imageName);
           }
           $data['images'] = json_encode($images);
        }

        DB::table('products')->insert($data);
        $notification = array(
            'messege' => 'Product Insert Successfull',
            'alert-type' => 'success',
        );
        return redirect()->route('index.product')->with($notification);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required|max:55',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'pickup_point_id' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'description' => 'required',
        ]);

        $subcategory = DB::table('subcategories')->where('id', $request->subcategory_id)->first();

        $data = array();
        $data['name']             = $request->name;
        $data['slug']             = Str::slug($request->name, '-');
        $data['category_id']      = $subcategory->category_id;
        $data['subcategory_id']   = $request->subcategory_id;
        $data['childcategory_id'] = $request->childcategory_id;
        $data['brand_id']         = $request->brand_id;
        $data['admin_id']         = Auth::id();
        $data['unit']             = $request->unit;
        $data['code']             = $request->code;
        $data['tags']             = $request->tags;
        $data['pickup_point_id']  = $request->pickup_point_id;
        $data['purchage_price']   = $request->purchage_price;
        $data['selling_price']    = $request->selling_price;
        $data['discount_price']   = $request->discount_price;
        $data['stock_quantity']   = $request->stock_quantity;
        $data['warehouse_id']     = $request->warehouse_id;
        $data['color']            = $request->color;
        $data['size']             = $request->size;
        $data['description']      = $request->description;
        $data['video']            = $request->video;
        $data['featured']         = $request->featured;
        $data['today_deal']       = $request->today_deal;
        $data['trendy']           = $request->trendy;
        $data['slider_product']   = $request->slider_product;
        $data['status']           = $request->status;



        $slug = Str::slug($request->name, '-');

        if ($request->thumbnail) {
            if (File::exists($request->old_thumbnail)) {
                unlink($request->old_thumbnail);
            }

            $photo = $request->thumbnail;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(600, 600)->save('public/files/product/'. $photoname);
            $data['thumbnail'] = 'public/files/product/'. $photoname;
        } else {
            $data['thumbnail'] =  $request->old_thumbnail;
        }


        //__multitple image update
        if ($request->has('old_images')) {
            $images = $request->old_images;
            $data['images'] = json_encode($images);
        } else {
            $images = array();
            $data['images'] = json_encode($images);
        }

        if ($request->hasFile('images')) {
            if (File::exists($request->hasFile('old_images'))) {
                unlink('public/files/product/'. $request->old_images);
            }
            foreach ($request->file('images') as $key => $image) {
               $imageName= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
               Image::make($image)->resize(600,600)->save('public/files/product/'.$imageName);
               array_push($images, $imageName);
            }
            
           $data['images'] = json_encode($images);
        } 
        

        DB::table('products')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Product Update Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }



    public function edit(Request $request, $id)
    {
        $category    = DB::table('categories')->get();
        $brand       = DB::table('brands')->get();
        $pickuppoint = DB::table('pickup_points')->get();
        $warehouse   = DB::table('warehouses')->get();
        $data        = DB::table('products')->where('id', $id)->first();
        $childcat    = DB::table('childcategories')->where('subcategory_id', $data->subcategory_id)->get();
        return view('admin.product.edit', compact('data', 'category', 'brand', 'pickuppoint', 'warehouse', 'childcat'));
    }



    public function destroy(Request $request, $id)
    {
        $getThumbnail = DB::table('products')->where('id', $id)->first();
        if ($getThumbnail->thumbnail) {
            if (File::exists($getThumbnail->thumbnail)) {
                unlink($getThumbnail->thumbnail);
            }
        }       

        $images = json_decode($getThumbnail->images, true);
        if ($images) {
            foreach($images as $image){
               if(File::exists('public/files/product/'.$image)) {
                unlink('public/files/product/'.$image);
               }
            }
        }
                
        DB::table('products')->where('id', $id)->delete();
        return response()->json('Product Delete Successfully');

    }


    //__get childcategory
    public function getChildCat($id)
    {
        $childcat = DB::table('childcategories')->where('subcategory_id', $id)->get();
        return response()->json($childcat);
    }

    //__active featured
    public function activeFeatured($id)
    {
        DB::table('products')->where('id', $id)->update(['featured' => 'off']);
        return response()->json('Featured deactivate');
    }

    //__deactive featured
    public function deactiveFeatured($id)
    {
        DB::table('products')->where('id', $id)->update(['featured' => 'on']);
        return response()->json('Featured activate');
    }

    //__active deal
    public function activeDeal($id)
    {
        DB::table('products')->where('id', $id)->update(['today_deal' => 'off']);
        return response()->json('Deal activate');
    }

    //__deactive deal
    public function deactiveDeal($id)
    {
        DB::table('products')->where('id', $id)->update(['today_deal' => 'on']);
        return response()->json('Deal deactivate');
    }

    //__active status
    public function activeStatus($id)
    {
        DB::table('products')->where('id', $id)->update(['status' => 'off']);
        return response()->json('Status deactive');
    }
    //__deactive status
    public function deactiveStatus($id)
    {
        DB::table('products')->where('id', $id)->update(['status' => 'on']);
        return response()->json('Status activate');
    }






}
