<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;

use Auth;

class AdminProfileController extends Controller
{
    //
    public function __construct(){
        // $this->middleware('auth:sanctum,admin');
    }

    public function adminProfile(){
        $adminData = Admin::find(Auth::user()->id);
        return view('admin/profile.admin_profile_view', compact('adminData'));
    }

    public function editProfile(){
        $editData = Admin::find(Auth::user()->id);
        return view('admin/profile.admin_profile_edit', compact('editData'));
    }

    public function updateProfile(Request $request){
        $data = Admin::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            if($data->profile_photo_path){
                @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            }
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['profile_photo_path']=$filename;
        }

        $data->save();
        $notification=array(
            'message'=>'Your profile has been updated successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function changePassword(){
        return view('admin/profile.change_password');
    }

    public function updatePassword(Request $request){
        $validateData=$request->validate([
            'current_password'=>'required',
            'password'=>'required|confirmed'
        ]);

        $hashedPassword=Auth::user()->password;

        if(Hash::check($request->current_password, $hashedPassword)){
            $user = Admin::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            $notification=array(
                'message'=>'Password has been change',
                'alert-type'=>'success'
            );
    
            return Redirect()->route('admin.logout')->with($notification);
        }else{
            $notification=array(
                'message'=>'Invalid current password',
                'alert-type'=>'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }

}
