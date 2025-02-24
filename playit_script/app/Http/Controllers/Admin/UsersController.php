<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersController extends MainAdminController{

    //Display Users List
    public function lists_users(Request $request){
        $data = User::orderBy('id', 'DESC')->paginate(10)->onEachSide(1);
        return view('admin.users.lists',compact('data'));
    }

    //Display Users Add
    public function add_users(){
        return view('admin.users.add');
    }

    //Display Users Edit
    public function edit_users($id){
        $users = User::find($id);
        return view('admin.users.edit',compact('users'));
    }

    //CODE Users Save
    public function save_users(Request $request){
        $this->validate($request,[
         'user_fullname' => 'required',
         'user_email' => 'required|email|unique:users,email',
         'user_password' => 'required|min:6',
        ],[
           'user_fullname.required' => "Full Name field is required",
           'user_email.email' => "Invalid email format",
           'user_email.unique' => "User email already exist",
           'user_password.size' => "Password must be 6 characters or more",
        ]);

        $user = new User();
        $user->name = $request->user_fullname;
        $user->email = $request->user_email;
        $user->password = Hash::make($request->user_password);
        $user->role = $request->user_role;

        if($request->user_role == 'administrators'){
            $user->assignRole('administrators');
        }else if($request->user_role == 'moderators'){
            $user->assignRole('moderators');
        }else if($request->user_role == 'authors'){
            $user->assignRole('authors');
        }

        $user->profile_img = 'default.png';
        $user->blocked = 0;
        $user->save();

        return redirect()->action([UsersController::class,'lists_users'])->with('success','User Created Successfully');
    }

    //CODE Users Update
    public function update_users(Request $request, $id){
        $this->validate($request,[
            'user_fullname' => 'required',
            'user_email' => 'required|email',
        ],[
            'user_fullname.required' => "Full Name field is required",
            'user_email.email' => "Invalid email format",
        ]);

        $user = User::find($id);
        $user->name = $request->user_fullname;
        $user->email = $request->user_email;
        $user->password = Hash::make($request->user_password);

        $user->role = $request->user_role;

        if($request->user_role == 'administrators'){
            $user->roles()->detach();
            $user->assignRole('administrators');
        }else if($request->user_role == 'moderators'){
            $user->roles()->detach();
            $user->assignRole('moderators');
        }else if($request->user_role == 'authors'){
            $user->roles()->detach();
            $user->assignRole('authors');
        }else{
            $user->roles()->detach();
        }

        $user->save();

        return redirect()->action([UsersController::class,'lists_users'])->with('success','User Updated Successfully');
    }

    //CODE Users Delete
    public function delete_users($id){
        $ids = trim($id, '[]');
        $usersid = explode(",",$ids);
        $users = User::whereIn('id', $usersid)->get();

        foreach ($users as $user ) {
            //Delete User
            $user->delete();
        }
        return redirect()->action([UsersController::class,'lists_users'])->with('success','Users Deleted Successfully');
    }

    //CODE Users Block
    public function block(Request $request){
        $users = User::find($request->id);
        if ($users->blocked == 1) {
            $users->blocked = 0;
        }else{
            $users->blocked = 1;
        }
        $users->save();
    }

}
