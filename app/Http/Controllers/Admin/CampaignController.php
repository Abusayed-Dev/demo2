<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; 
use Image;
use File;
use DataTables;
use App\Models\Campaign;
use Str;



class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('campaigns')->orderBy('id', 'DESC')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('image', function ($row)
                    {
                        if ($row->image) {
                            return '<img class="img-fluid" src="'.asset($row->image).'" />';
                        }
                    })
                    ->editColumn('status', function ($row)
                    {
                        if ($row->status == 1) {
                            return '<span class="badge badge-success">Active</span>';
                        }
                    })
                    ->addColumn('action', function ($row){
                       $actionBtn = '<a href="'. route('edit.campaign', [$row->id]) .'" class="btn btn-sm btn-info mr-2 edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></a>
                            <a href="'. route('delete.campaign', [$row->id]) .'" id="ajaxdelete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                            </a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action', 'status', 'image'])
                    ->make(true);
        }

        return view('admin.campaign.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:campaigns',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount' => 'required',
            'status' => 'required',
        ]);

        $data = array();
        $data['title']      = $request->title;
        $data['start_date'] = $request->start_date;
        $data['end_date']   = $request->end_date;
        $data['discount']   = $request->discount;
        $data['status']     = $request->status;
        $data['month']      = date('F');
        $data['year']       = date('Y');

        $photo = $request->image;
        $photoname = uniqid().'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(468, 90)->save('public/files/campaign/'. $photoname);
        $data['image'] = 'public/files/campaign/'. $photoname;

        Campaign::insert($data);
        $notification = array(
            'messege' => 'Campaign added Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['title']      = $request->title;
        $data['start_date'] = $request->start_date;
        $data['end_date']   = $request->end_date;
        $data['discount']   = $request->discount;
        $data['status']     = $request->status;

        if ($request->image) {
            if (File::exists($request->old_image)) {
                unlink($request->old_image);
            }

            $photo = $request->image;
            $photoname = uniqid().'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(468, 90)->save('public/files/campaign/'. $photoname);
            $data['image'] = "public/files/campaign/".$photoname;

            Campaign::where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Campaign Updated Successfull',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);

        } else {
            $data['image'] = $request->old_image;

            Campaign::where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Campaign Updated Successfull',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }

        
    }


    public function edit($id)
    {
        $campaign = Campaign::where('id', $id)->first();
        return view('admin.campaign.edit', compact('campaign'));
    }


    public function destroy($id)
    {
        $getImg = Campaign::where('id', $id)->first();
        unlink($getImg->image);

        Campaign::where('id', $id)->delete();
        return response()->json('Delete Successfull');
    }

}
