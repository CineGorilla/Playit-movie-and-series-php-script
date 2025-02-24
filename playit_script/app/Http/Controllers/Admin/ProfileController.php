<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Image;
use File;

class ProfileController extends MainAdminController{  
    
    //Display Edit Profile
    public function edit_profile(Request $request){
        $user = Auth::user();
        return view('admin.profile.edit',compact('user'));
    }   

    //CODE Profile Save
    public function save_profile(Request $request,$id){
        $this->validate($request,[
         'user_name' => 'required',
        ],[
           'user_name.required' => "Name field is required",
        ]);

        $user = User::find($id);
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->country = $request->user_country;

        if(isset($request->user_password)){
            $user->password = Hash::make($request->user_password);
        } 

        $user->facebook = $request->user_facebook;
        $user->pinterest = $request->user_pinterest;
        $user->linkedin = $request->user_linkedin;
        $user->twitter = $request->user_twitter;
        $user->youtube = $request->user_youtube;

        $profile_img = $request->file('user_image');
        if($profile_img == ''){
            if($user->profile_img == ''){
                $user->profile_img = 'default.png';
            }
        }else{
            $extension_poster = $profile_img->getClientOriginalExtension();
            $file_user_profile = 'user_'.$user->id.'.'.$extension_poster;
            Image::make($profile_img)->fit(800)->save(public_path('/profile_img/'.$file_user_profile));
            $user->profile_img = $file_user_profile;
        }
        $user->save();

        return redirect()->action([ProfileController::class,'edit_profile'])->with('success','Profile Updated Successfully');

    }

   

}