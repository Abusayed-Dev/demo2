<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;
use Image;



class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function seo()
    {
        $seo_data = DB::table('seos')->first();
        return view('admin.setting.seo_setting', compact('seo_data'));
    }

    public function updateSeo(Request $request, $id)
    {
        $data = array();
        $data['meta_title']          = $request->meta_title;
        $data['meta_author']         = $request->meta_author;
        $data['meta_tag']            = $request->meta_tag;
        $data['meta_description']    = $request->meta_description;
        $data['google_verification'] = $request->google_verification;
        $data['google_analytics']    = $request->google_analytics;
        $data['google_adsense']      = $request->google_adsense;
        $data['alexa_verification']  = $request->alexa_verification;

        DB::table('seos')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Seo Setting Update Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    //__smtp method

    public function smtp()
    {
        $smtp = DB::table('smtp')->first();
        return view('admin.setting.smtp', compact('smtp'));
    }

    public function updateSmtp(Request $request, $id)
    {
        $data = array();
        $data['mailer']    = $request->mailer;
        $data['host']      = $request->host;
        $data['port']      = $request->port;
        $data['user_name'] = $request->user_name;;
        $data['password']  = $request->password;;

        DB::table('smtp')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'SMTP Update Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }



    //__website setting
    public function wesite()
    {
        $setting = DB::table('settings')->first();
        return view('admin.setting.website_setting', compact('setting'));
    }

    public function updateWebsite(Request $request, $id)
    {
        $data = array();
        $data['currency']       = $request->currency;
        $data['address']        = $request->address;
        $data['phone_one']      = $request->phone_one;
        $data['phone_two']      = $request->phone_two;
        $data['phone_two']      = $request->phone_two;
        $data['main_email']     = $request->main_email;
        $data['support_email']  = $request->support_email;
        $data['facebook']   = $request->facebook;
        $data['twitter']    = $request->twitter;
        $data['instagram']  = $request->instagram;
        $data['youtube']    = $request->youtube;
        $data['pinterest']  = $request->pinterest;

        if ($request->logo) {

            if (File::exists($request->old_logo)) {
                unlink($request->old_logo);
            }

            $logo = $request->logo;
            $photoname = uniqid().'.'.$logo->getClientOriginalExtension();
            Image::make($logo)->resize(320, 120)->save('public/files/website_setting/'. $photoname);
            $data['logo'] = 'public/files/website_setting/'. $photoname;
        } else{
            $data['logo'] = $request->old_logo;
        }

        if ($request->favicon) {

            if (File::exists($request->old_favicon)) {
                unlink($request->old_favicon);
            }

            $favicon = $request->favicon;
            $photoname = uniqid().'.'.$favicon->getClientOriginalExtension();
            Image::make($favicon)->resize(320, 120)->save('public/files/website_setting/'. $photoname);
            $data['favicon'] = 'public/files/website_setting/'. $photoname;
        } else{
            $data['favicon'] = $request->old_favicon;
        }


        DB::table('settings')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Website Setting Updated Successfull',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }




}
