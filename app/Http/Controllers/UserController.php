<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view('frontend.home.index');
    }

    public function userDashboard(){
        return view('dashboard');
    }

    public function userProfile(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.profile',compact('userData'));
    }

    public function userProfileStore(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$user->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $user['photo'] = $filename;
        }

        $user->save();

        $notification = array(
            'message'=>'User Profile Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }

    public function userLogout(Request $request){
         Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message'=>'User Logout Successfully.',
            'alert-type'=>'success'
       );

        return redirect('/login')->with($notification);
    }

    public function userChangePassword(){
        return view('frontend.dashboard.change_password');
    }

    public function userUpdatePassword(Request $request){
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required|confirmed',
        ]);

        if(!Hash::check($request->old_password,auth::user()->password)){
            $notification = array(
            'message'=>'Old Password Does Not Match',
            'alert-type'=>'error'
            );
            return back()->with($notification);
        }

        User::whereId(auth::user()->id)->update([
            'password'=>Hash::make($request->new_password)
        ]);

        $notification = array(
            'message'=>'Password Changed successfully.',
            'alert-type'=>'success'
       );

       return redirect()->back()->with($notification);
    }


}
