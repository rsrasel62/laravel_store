<?php

namespace App\Http\Controllers;

use App\Models\GuestLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuestloginController extends Controller
{
    function guest_login_req(Request $request){
        if(Auth::guard('guestlogin')->attempt(['email'=>$request->email, 'password'=>$request->password ])){
            if(Auth::guard('guestlogin')->user()->verified_mail == null){
                Auth::guard('guestlogin')->logout();
                return redirect()->route('mail.verifi.req')->with([
                    'resendmail'=>'Please verifi your account be first',
                    'mail'=>$request->email,
                ]);
            }
            else{
            return redirect()->route('fontend')->withLogin_success('You have successfully login');
        }
        }
        else{
            return redirect()->route('guest.login.me');
        }
    }
    function guest_logout(){
        Auth::guard('guestlogin')->logout();
        return redirect()->route('guest.login.me');
    }


    //profile
    function guest_profile(){
        return view('fontend.guest_profile');
    }
    function guest_profile_update(Request $request){
        if($request->password == ''){
             GuestLogin::find(Auth::guard('guestlogin')->id())->update([
                'name'=>$request->name,
                'email'=>$request->email,
             ]);
             return back()->with('success', 'guest profile updated!');;

        }
        else{
            if(Hash::check($request->old_password, Auth::guard('guestlogin')->user()->password)){
                GuestLogin::find(Auth::guard('guestlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password),
                ]);
                return back()->with('success', 'guest profile updated!');
            }
            else{
                return back()->with('wrong','Wrong password');
            }
        }
    }
}
