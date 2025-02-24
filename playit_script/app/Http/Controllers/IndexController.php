<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller{

	public function index(){
		if(!$this->alreadyInstalled()) {
            return redirect('install');
        }
		return view('index');
	}

	public function alreadyInstalled(){   
        return file_exists(base_path('/storage/installed'));
    }

}