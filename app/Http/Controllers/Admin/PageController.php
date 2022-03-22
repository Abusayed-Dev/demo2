<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Str;


class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //__page method
    public function page()
    {
        $data = DB::table('pages')->orderBy('id', 'DESC')->get();
        return view('admin.setting.page.index', compact('data'));
    }


    public function pageCreate()
    {
        return view('admin.setting.page.create_page');
    }

    public function pageStore(Request $request)
    {
        $validated = $request->validate([
            'page_name' => 'required',
            'page_title' => 'required',
            'page_description' => 'required',
            'page_position' => 'required',
        ]);

        $data = array();
        $data['page_name']     = $request->page_name;
        $data['page_title']    = $request->page_title;
        $data['page_slug']     = Str::slug($request->page_name, '-');
        $data['page_position'] = $request->page_position;
        $data['page_description'] = $request->page_description;
        
        DB::table('pages')->insert($data);
         $notification = array(
            'messege' => 'Page Insert Successfull',
            'alert-type' => 'success',
        );
        return redirect()->route('page.setting.index')->with($notification);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'page_name' => 'required',
            'page_title' => 'required',
            'page_description' => 'required',
            'page_position' => 'required',
        ]);

        $data = array();
        $data['page_name']     = $request->page_name;
        $data['page_title']    = $request->page_title;
        $data['page_slug']     = Str::slug($request->page_name, '-');
        $data['page_position'] = $request->page_position;
        $data['page_description'] = $request->page_description;
        
        DB::table('pages')->where('id', $id)->update($data);
         $notification = array(
            'messege' => 'Page update Successfull',
            'alert-type' => 'success',
        );
        return redirect()->route('page.setting.index')->with($notification);
    }

    public function edit($id)
    {
        $data = DB::table('pages')->where('id', $id)->first();
        return view('admin.setting.page.edit', compact('data'));
    }

    public function destroy($id)
    {
        $data = DB::table('pages')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Page delete Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }





}
