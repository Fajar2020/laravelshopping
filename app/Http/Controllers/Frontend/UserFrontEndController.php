<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use Auth;

class UserFrontEndController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function userLogout(){
        Auth::logout();
        return Redirect()->route('login')->with('success', 'User Logout');
    }

    public function userProfile(){
        if(Auth::user()){
            $user=User::find(Auth::user()->id);
            if($user){
                return view('frontend.profile.user_profile', compact('user'));
            }
        }
    }

    public function userProfileStore(Request $request){
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            if($data->profile_photo_path){
                // error_log("masuk ke if");
                @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            }
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['profile_photo_path']=$filename;
        }

        $data->save();
        $notification=array(
            'message'=>'Your profile has been updated successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    public function changePassword(){
        return view('frontend.profile.change_password');
    }

    public function updatePassword(Request $request){
        $validateData=$request->validate([
            'current_password'=>'required',
            'password'=>'required|confirmed'
        ]);

        $hashedPassword=Auth::user()->password;

        if(Hash::check($request->current_password, $hashedPassword)){
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            $notification=array(
                'message'=>'Password has been change',
                'alert-type'=>'success'
            );
    
            return Redirect()->route('user.logout')->with($notification);
        }else{
            $notification=array(
                'message'=>'Invalid current password',
                'alert-type'=>'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
