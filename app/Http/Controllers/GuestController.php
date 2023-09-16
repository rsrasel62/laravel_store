<?php

namespace App\Http\Controllers;

use App\Models\GuestLogin;
use App\Models\GuestMailVerify;
use App\Models\GuestPassreset;
use App\Notifications\GuestmailVerifyNotification;
use App\Notifications\GuestPassResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Symfony\Contracts\Service\Attribute\Required;

class GuestController extends Controller
{
    function register_guest(){
        return view('fontend.guest_register');
    }
    function login_guest(){
        return view('fontend.guest_login');
    }

    function email_verify_req(){
        if(Auth::guard('guestlogin')->user()){
            if(Auth::guard('guestlogin')->user()->verified_mail == null){
                return view('fontend.mail_verfifi_req');
            }else{
                return redirect('/');
            }
        }else{
            return view('fontend.mail_verfifi_req');
        }
  
    }


    function guest_store(Request $request){
        $request->validate([
            'name'=>'required',
            'password'=>'required',
            'email'=>'required|unique:guest_logins',
          ]);
       $guest_info =  GuestLogin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);

        $guest_info_inserted = GuestMailVerify::create([
                'guest_id'=>$guest_info->id,
                'token'=>uniqid(),
                'created_at'=>Carbon::now(),
        ]);

        Notification::send($guest_info, new GuestmailVerifyNotification($guest_info_inserted));
        return back()->withMaill('You have send you a message for verified to mail, Please check Your mail!');

        // if(Auth::guard('guestlogin')->attempt(['email'=>$request->email, 'password'=>$request->password ])){
        //     return redirect()->route('fontend')->withLogin_success('You have successfully login');
        // }    
    }
    //email verffi 
    function email_verify($token){
        $guest = GuestMailVerify::where('token', $token)->firstOrFail();
        GuestLogin::findOrFail($guest->guest_id)->update([
            'verified_mail'=>Carbon::now()->format('Y-m-d')
        ]);
        $guest->delete();
        return redirect()->route('guest.login.me')->withVerified('Email verified, now you can login!');
    }

    function mail_verifi_again(Request $request){
        $guest_info = GuestLogin::where('email', $request->email)->firstOrFail();
        GuestMailVerify::where('guest_id', $guest_info->id)->delete();
        
        $guest_insert = GuestMailVerify::create([
            'guest_id'=>$guest_info->id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);
        Notification::send($guest_info, new GuestmailVerifyNotification($guest_insert));
        return back()->withResend('You have send you a message again, Please check Your mail!');
    }

    //pass reset
    function guest_pass_reset(){
        return view('fontend.guest_pass_reset');
    }
    function guest_pass_reset_send(Request $request){
        $guest_info = GuestLogin::where('email', $request->email)->firstOrFail();
        GuestPassreset::where('guest_id', $guest_info->id)->delete();
        
        $guest_insert = GuestPassreset::create([
            'guest_id'=>$guest_info->id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);

        Notification::send($guest_info, new GuestPassResetNotification($guest_insert));
        return back()->withResend('You have send you a message, Please check Your mail!');
    }
    function guest_pass_reset_form($token){
        if(GuestPassreset::where('token', $token)->exists()){
         return view('notification.pass_reset_form',[
            'token'=>$token,
        ]);
        }else{
            abort('404');
        }

    }
    function guest_pass_reset_confirm(Request $request){
        $guest_info = GuestPassreset::where('token', $request->token)->firstOrFail();
        GuestLogin::findOrFail($guest_info->guest_id)->update([
            'password'=>bcrypt($request->password),
        ]);
        $guest_info->delete();

        return redirect()->route('guest.login.me')->withSuccess('Password Reset successfully');
    }
}
