<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function tag(){
        $tags = Tag::all();
        return view('admin.tag.tag',[
            'tags'=>$tags,
        ]);
    }
    function tag_store(Request $request){
        $request->validate([
            'tag_name'=>'required|unique:tags',
            
        ],[
            'tag_name.required|unique:tags'=>'name de',
            'tag_name.unique'=>'ek nam kobar des',
        ]);

        Tag::insert([
            'tag_name'=>$request->tag_name,
        ]);
        return back()->withSuccess('submit');
    }
    function tag_delete($tag_id){
        Tag::find($tag_id)->delete();
        return back();
    }

}
