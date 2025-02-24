<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\Settings;
use App\Models\SeoSettings;
use App\Models\Advertisements;
use Illuminate\Http\Request;

use Cookies;

class SettingsComposer{

	private $request;

    public function __construct(Request $request)
    {
       $this->request = $request;
    }

    public function compose(View $view)
    {
    	$general = Settings::findOrFail('1');
        $seosettings = SeoSettings::findOrFail('1');
        $ads = Advertisements::findOrFail('1');
        $style = $this->request->cookie('style');
        $view->with('general', $general);
        $view->with('seosettings', $seosettings);
        $view->with('ads', $ads);
        $view->with('style', $style);
    }
}
