<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\Items;

class SlidersComposer{
    public function compose(View $view)
    {
    	$sliders = Items::where('feature',1)->orderBy('id','DESC')->get();
        $view->with('sliders', $sliders);
    }
}
