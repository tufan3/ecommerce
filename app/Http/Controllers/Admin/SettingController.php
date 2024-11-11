<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\Smtp;
use Illuminate\Http\Request;
use DB;

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
}
