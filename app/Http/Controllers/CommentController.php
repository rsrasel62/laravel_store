<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    function comment_store(Request $request){
        Comment::create([
            'guest_id'=>Auth::guard('guestlogin')->id(),
            'post_id'=>$request->post_id,
            'comment'=>$request->comment,
            'parent_id'=>$request->parent_id,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }
}
