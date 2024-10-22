<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminDashboard(){
        return view('backend.admin.index');
    }

    public function agentDashboard(){
        return view('backend.agent.index');
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message'=>'Admin Logout Successfully.',
            'alert-type'=>'success'
       );

        return redirect('/admin/login')->with($notification);
    }

    public function adminLogin(){
        $notification = array(
            'message'=>'Admin Login Successfully.',
            'alert-type'=>'success'
       );
        return view('backend.admin.login');
    }

    public function adminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);


        return view('backend.admin.profile',compact('profileData'));
    }

    public function adminProfileStore(Request $request){

       $id = Auth::user()->id;
       $user = User::find($id);

       $user->username = $request->username;
       $user->name = $request->name;
       $user->email = $request->email;
       $user->phone = $request->phone;

       if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$user->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(\public_path('upload/admin_images'),$fileName);
            $user['photo'] =$fileName;
       }

       $user->save();

       $notification = array(
            'message'=>'Admin Profile Updated successfully.',
            'alert-type'=>'success'
       );

       return redirect()->back()->with($notification);
    }

    public function adminChangePassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('backend.admin.change_password',compact('profileData'));
    }

    public function adminUpdatePassword(Request $request){
        // validation

        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required|confirmed',
        ]);
        // matching old password

        if(!Hash::check($request->old_password,auth::user()->password)){
            $notification = array(
            'message'=>'Old Password Does Not Match',
            'alert-type'=>'error'
            );
            return back()->with($notification);
        };

        // updating new password
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
