<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class FontendController extends Controller
{
    function fontend(){
        $post_slider = Post::latest('created_at')->take(3)->get();
        $recent_posts = Post::latest('created_at')->paginate(2);
        $categories = Category::all();
        $tags = Tag::all();
        return view('fontend.index',[
            'post_slider'=>$post_slider,
            'categories'=>$categories,
            'recent_posts'=>$recent_posts,
            'tags'=>$tags,
        ]);
    }


    function category_post($category_id){
        $category_info = Category::find($category_id);
        $category_posts = Post::where('category_id', $category_id)->paginate(2);
        return view('fontend.category_post',[
            'category_posts'=>$category_posts,
            'category_info' => $category_info,
        ]);
    }


    function author_post($author_id){

        $author_post = Post::where('author_id', $author_id)->get();
        $author_info = User::find($author_id);
        $tags = Tag::all();
        return view('fontend.author_post',[
            'author_post'=>$author_post,
            'author_info'=>$author_info,
            'tags'=>$tags,
        ]);
    }

    function author_list(){
        $author_list = Post::select('author_id')->groupBy('author_id')
        ->selectRaw('author_id, sum(author_id) as sum')
        ->get();;

        return view('fontend.author_list',[
            'author_lists'=>$author_list,
        ]);
    }
    function about(){
        $abouts = About::all()->first();
        return view('fontend.about_me',[
            'abouts'=>$abouts,
        ]);
      }

    function contact(){
        return view('fontend.contact');
    }

    function details_post($slug){
        $post_details = Post::where('slug', $slug)->get();
        $comments = Comment::with('replies')->where('post_id', $post_details->first()->id)->whereNull('parent_id')->get();

        return view('fontend.details_post',[
            'post_details'=>$post_details,
            'comments'=>$comments,
        ]); 
    }
}
