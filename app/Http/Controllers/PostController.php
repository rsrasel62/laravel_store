<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Image;

class PostController extends Controller
{
    function add_post(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.add_post',[
            'categories'=>$categories,
            'tags'=>$tags,
        ]);
    }
    function post_store(Request $request){
      $emplode_tag_id = implode(',', $request->tag_id);
      $post_id = Post::insertGetId([
        'author_id'=>Auth::id(),
        'category_id'=>$request->category_id,
        'title'=>$request->title,
        'short_desp'=>$request->short_desp,
        'desp'=>$request->desp,
        'tag_id'=>$emplode_tag_id,
        'feat_image'=>$request->feat_image,
        'slug'=>Str::lower(str_replace(' ','-',$request->title)).'-'.rand(10000, 99999),
        'created_at'=>Carbon::now(),
      ]);
      $uploaded_file = $request->feat_image;
      $extansion = $uploaded_file->getClientOriginalExtension();
      $file_name = Str::lower(str_replace(' ','-',Auth::user()->name)).'-'.rand(1000, 9999).'.'.$extansion;
      Image::make($uploaded_file)->save(public_path('uploads/post/'.$file_name));

      $update = Post::find($post_id)->update([
        'feat_image'=>$file_name,
      ]);
      return back();
    }
    function post(){
      $my_post = Post::where('author_id', Auth::id())->get();
      return view('admin.post.post',[
        'my_post'=>$my_post,
      ]);
    }
    function view_post($post_id){
      $post = Post::find($post_id);
      return view('admin.post.view_post',[
        'post'=>$post,
      ]);
    }
    function post_delete($post_id){
      $post = Post::find($post_id);
      $image_delete = public_path(('uploads/post/'.$post->feat_image));
      unlink($image_delete);
      Post::find($post_id)->delete();
      return back();
    }
    function post_edit($post_id){
      $categories = Category::all();
      $tags = Tag::all();
      $post_info = Post::find($post_id);
      return view('admin.post.post_edit',[
        'categories'=>$categories,
        'tags'=>$tags,
        'post_info'=>$post_info,
      ]);
    }
    function post_update(Request $request){
      $after_emplode = implode(',', $request->tag_id);
      if($request->feat_image == null){
        Post::find($request->post_id)->update([
          'category_id'=>$request->category_id,
          'title'=>$request->title,
          'desp'=>$request->desp,
          'short_desp'=>$request->short_desp,
          'tag_id'=>$after_emplode,
  
        ]);
      }
      else{
        $post_image = Post::find($request->post_id);
        $delete_image = public_path('uploads/post/'.$post_image->feat_image);
        unlink($delete_image);

        $uploaded_file = $request->feat_image;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ','-',Auth::user()->name)).'-'.rand(1000, 9999).'.'.$extension;
        Image::make($uploaded_file)->save('uploads/post/'.$file_name);

        $after_emplode = implode(',', $request->tag_id);

        Post::find($request->post_id)->update([
            'category_id'=>$request->category_id,
            'title'=>$request->title,
            'desp'=>$request->desp,
            'short_desp'=>$request->short_desp,
            'tag_id'=>$after_emplode,
            'feat_image'=>$file_name,
        ]);
 

    }
    return back();
 }

 //about_us


        function about_us(){
          $abouts = About::all();
          return view('admin.post.about_us',[
            'abouts'=>$abouts,
          ]);
        }
        function add_about(Request $request){
          $request->validate([
            'title'=>'required',
            'desp'=>'required',
          ]);

          $uploaded_file = $request->image;
          $extension = $uploaded_file->getClientOriginalExtension();
          $file_name = Str::lower(str_replace(' ','-',Auth::user()->name)).'-'.rand(100,999).'.'.$extension;
          Image::make($uploaded_file)->save('uploads/about/'.$file_name);

          About::insert([
          'title'=>$request->title,
          'desp'=>$request->desp,
          'created_at'=>Carbon::now(),
          'image'=>$file_name,
          ]);
          return back();
        }

        function delete_about($about_id){
          $image = About::find($about_id);
          $image_delete = public_path(('uploads/about/'.$image->image));
          unlink($image_delete);
          About::find($about_id)->delete();
          return back();

        }
 }

