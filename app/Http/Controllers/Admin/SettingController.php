<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\Setting;
use App\Models\Smtp;
use Illuminate\Http\Request;
use DB;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__seo setting__//
    public function seoSetting()
    {
        $data = Seo::first();
        return view('admin.setting.seo',compact('data'));
    }
    //__seo setting__//

    //__seo setting update__//
    public function seoSettingUpdate(Request $request, $id)
    {
        $data = Seo::find($id);
        $data->meta_title = $request->meta_title;
        $data->meta_author = $request->meta_author;
        $data->meta_tag = $request->meta_tag;
        $data->meta_description = $request->meta_description;
        $data->meta_keyword = $request->meta_keyword;
        $data->google_verification = $request->google_verification;
        $data->google_analytics = $request->google_analytics;
        $data->alexa_verification = $request->alexa_verification;
        $data->google_adsense = $request->google_adsense;
        $data->save();
        $notification = array('message' => 'SEO Setting Update Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }
    //__seo setting update__//


    //__smtp setting__//
    public function smtpSetting()
    {
        // $smtp = DB::table('smtps')->first();
        $smtp = Smtp::first();
        return view('admin.setting.smtp',compact('smtp'));
    }
    //__smtp setting__//

    //__smtp setting update__//
    public function smtpSettingUpdate(Request $request, $id)
    {
        $data = Smtp::find($id);
        $data->mailer = $request->mailer;
        $data->host = $request->host;
        $data->port = $request->port;
        $data->user_name = $request->user_name;
        $data->password = $request->password;
        $data->save();
        $notification = array('message' => 'SMTP Setting Update Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }
    //__smtp setting update__//

    //__website setting__//
    public function websiteSetting()
    {
        $website = Setting::first();
        return view('admin.setting.website_setting',compact('website'));
    }
    //__website setting__//


    //__website setting update__//
    public function websiteSettingUpdate(Request $request, $id)
    {
        $setting = Setting::find($id);
        $setting->currency = $request->currency;
        $setting->phone_one = $request->phone_one;
        $setting->phone_two = $request->phone_two;
        $setting->main_email = $request->main_email;
        $setting->support_email = $request->support_email;
        $setting->address = $request->address;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->instagram = $request->instagram;
        $setting->linkedin = $request->linkedin;
        $setting->youtube = $request->youtube;

        $logo = $request->logo;
        $favicon = $request->favicon;

        if ($logo) {
            if ($setting->logo && file_exists($setting->logo)) {
                unlink($setting->logo);
            }
            $logo_name = uniqid() . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(320, 120)->save('public/files/website_setting/' . $logo_name);
            $setting->logo = 'public/files/website_setting/' . $logo_name;
        }else{
            $setting->logo = $request->old_logo;
        }

        if ($favicon) {
            if ($setting->favicon && file_exists($setting->favicon)) {
                unlink($setting->favicon);
            }

            $favicon_name = uniqid() . '.' . $favicon->getClientOriginalExtension();
            Image::make($favicon)->resize(32, 32)->save('public/files/website_setting/' . $favicon_name);
            $setting->favicon = 'public/files/website_setting/' . $favicon_name;
        }else{
            $setting->favicon = $request->old_favicon;
        }

        $setting->save();
        $notification = array('message' => 'Website Setting Update Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //__website setting update__//
}
