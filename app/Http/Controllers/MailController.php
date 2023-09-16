<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Mail;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MailController extends Controller
{
    function email(Request $request){
        Mail::insert([
            'email'=>$request->email,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }

    //contact
    function mess_contact(Request $request){
        Contact::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }

}
