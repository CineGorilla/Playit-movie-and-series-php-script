<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Models\Settings;
use App\Models\SeoSettings;
use App\Models\Advertisements;

class SettingsController extends MainAdminController{
    //Display General Settings
    public function general_settings(Request $request){
        $general = Settings::findOrFail('1');
        return view('admin.settings.general',compact('general'));
    }

    //Display Search Engines Settings
    public function search_engines(){
        $seosettings = SeoSettings::findOrFail('1');
        return view('admin.settings.searchengines',compact('seosettings'));
    }

    //Display Advertisement Settings
    public function advertisement(){
        $ads = Advertisements::findOrFail('1');
        return view('admin.settings.advertisement',compact('ads'));
    }

    public function update_general_settings(Request $request){
        $this->validate($request,[
            'site_name' => 'required',
            'site_email' => 'required'
        ]);

        $settings = Settings::findOrFail('1');
        $settings->site_name = $request->site_name;
        $settings->site_title = $request->site_title;
        $settings->site_description = $request->site_description;
        $settings->site_keywords = $request->site_keywords;
        $settings->site_items_per_page = $request->site_items_per_page;

        $settings->site_author = $request->site_author;
        $settings->site_email = $request->site_email;
        $settings->site_copyright = $request->site_copyright;
        $settings->site_twitter = $request->site_twitter;
        $settings->site_youtube = $request->site_youtube;
        $settings->site_pinterest = $request->site_pinterest;
        $settings->site_linkedin = $request->site_linkedin;
        $settings->site_facebook = $request->site_facebook;
        $settings->site_style = $request->site_style;
        $settings->site_player = $request->site_player;

        $settings->site_comments_moderation = $request->site_comments_moderation ? 1 : 0 ?? 0;
        $settings->maintenance = $request->maintenance ? 1 : 0 ?? 0;
        $settings->site_maintenance_description = $request->site_maintenance_description;

        $settings->save();

        if($request->file('site_logo')){
            @unlink(public_path('/setting_img/'.$settings->site_logo));
            $file = $request->file('site_logo');
            $extension = $file->getClientOriginalExtension();
            $logo = 'logo.'.$extension;
            $file->move(public_path('/setting_img'),$logo);
            $settings->site_logo = $logo;
            $settings->save();
        }

        if($request->file('site_favicon')){
            @unlink(public_path('/setting_img/'.$settings->site_favicon));
            $file = $request->file('site_favicon');
            $extension = $file->getClientOriginalExtension();
            $favicon = 'favicon.'.$extension;
            $file->move(public_path('/setting_img'),$favicon);
            $settings->site_favicon = $favicon;
            $settings->save();
        }

        return redirect()->back()->with('success','Settings Updated Successfully');
    }

    public function update_search_engines_settings(Request $request){
        $SeoSettings = SeoSettings::findOrFail('1');
        $SeoSettings->site_google_verification_code = $request->site_google_verification_code;
        $SeoSettings->site_bing_verification_code = $request->site_bing_verification_code;
        $SeoSettings->site_yandex_verification_code = $request->site_yandex_verification_code;
        $SeoSettings->site_google_analytics = $request->site_google_analytics;
        $SeoSettings->site_robots = $request->site_robots;
        $SeoSettings->save();
        return redirect()->back()->with('success','SEO Settings Updated Successfully');
    }

    public function update_advertisement_settings(Request $request){
        $advertisement = Advertisements::findOrFail('1');
        $advertisement->activate = $request->activate ? 1 : 0 ?? 0;
        $advertisement->site_728x90_banner = base64_encode($request->site_728x90_banner);
        $advertisement->site_468x60_banner = base64_encode($request->site_468x60_banner);
        $advertisement->site_300x250_banner = base64_encode($request->site_300x250_banner);
        $advertisement->site_320x100_banner = base64_encode($request->site_320x100_banner);
        $advertisement->site_popunder = base64_encode($request->site_popunder);
        $advertisement->site_sticky_banner = base64_encode($request->site_sticky_banner);
        $advertisement->site_push_notifications = base64_encode($request->site_push_notifications);
        $advertisement->site_desktop_fullpage_interstitial = base64_encode($request->site_desktop_fullpage_interstitial);
        $advertisement->save();
        return redirect()->back()->with('success','Advertisement Settings Updated Successfully');
    }
}
