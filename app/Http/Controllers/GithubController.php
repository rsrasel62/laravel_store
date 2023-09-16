<?php

namespace App\Http\Controllers;

use App\Models\GuestLogin;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GithubController extends Controller
{
    function github_redirect(){
        return Socialite::driver('github')->redirect();
    }
    function github_callback(){
        $user = Socialite::driver('github')->user();
            if(GuestLogin::where('email', $user->getEmail())->exists()){
                if(Auth::guard('guestlogin')->attempt(['email'=>$user->getEmail(), 'password'=>'abc@123'])){
                    return redirect()->route('fontend')->withLogin_success('You have successfully login');
                   }
                }
                else{
                    GuestLogin::insert([
                        'name'=>$user->getName(),
                        'email'=>$user->getEmail(),
                        'password'=>bcrypt('abc@123'),
                        'created_at'=>Carbon::now(),
                    ]);
                    if(Auth::guard('guestlogin')->attempt(['email'=>$user->getEmail(), 'password'=>'abc@123'])){
                        return redirect()->route('fontend')->withLogin_success('You have successfully login');
                    }
                }
            }



 }

