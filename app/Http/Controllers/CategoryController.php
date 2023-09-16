<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Str;
use Image;

class CategoryController extends Controller
{
    function category(){
        $categories = Category::all();
        return view('admin.category.category',[
            'categories'=>$categories,
        ]);
    }
    function category_store(Request $request){
        $request->validate([
            'category_name'=>'required|unique:categories',
            'category_image'=>'required|mimes:png,jpg|max:5000',
        ]);

        $Category_id = Category::insertGetId([
            'category_name'=>$request->category_name,
            'created_at'=>Carbon::now(),

        ]);

        //
        $uploaded_file = $request->category_image;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ','-', $request->category_name)).'-'.rand(10000,99999).'.'.$extension;
        Image::make($uploaded_file)->resize(250,200)->save(public_path('/uploads/category/'.$file_name));

        Category::find($Category_id)->update([
            'category_image'=>$file_name,
        ]);
        return back()->withSuccess('category added!');
    }

    function category_delete($category_id){
        $delete_photo = Category::where('id', $category_id)->first()->category_image;
        $delete_from =  public_path('uploads/category/'.$delete_photo);
        unlink($delete_from);
        Category::find($category_id)->delete();
        return back()->withSuccesss('This is deleted!');
    }
    function category_edit($category_id){
        $category = Category::find($category_id);
        return view('admin.category.edit',[
            'category'=>$category,
        ]);
    }
    function category_update(Request $request){
        if($request->category_image == ''){
            Category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
            ]);
            return back();
        }
        else{
            $delete_photo = Category::where('id', $request->category_id)->first()->category_image;
            $delete_from =  public_path('uploads/category/'.$delete_photo);
            unlink($delete_from);
            $uploaded_file = $request->category_image;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ','-', $request->category_name)).'-'.rand(10000,99999).'.'.$extension;
            Image::make($uploaded_file)->resize(250,200)->save(public_path('/uploads/category/'.$file_name));

            Category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
                'category_image'=>$file_name,
            ]);
            return back();
        }

    }
}
