<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function users(){
        // $users = User::where('id', '!=', Auth::user()->id)->get();
        $users = User::where('id', '!=', Auth::id())->orderBy('created_at', 'desc')->simplePaginate(10);
        $count_user = User::count();
        return view('admin.users.user', compact('users', 'count_user'));
    }

    function trash(){
        $users = User::onlyTrashed()->where('id', '!=', Auth::id())->paginate(10);
        $count = User::onlyTrashed()->count();
        return view('admin.users.trash',[
            'users'=>$users,
            'count'=>$count,
        ]);
    }
    function restore($user_id){
        User::withTrashed()->find($user_id)->restore();
        return back();
    }


    function user_delete($user_id){
        User::find($user_id)->delete();
        return back();
    }
    function hard_delete($user_id){
        $image = User::onlyTrashed()->find($user_id);
        if($image->image == null){
            User::onlyTrashed()->find($user_id)->forceDelete();
            return back();
        }
        else{
            $delete_form = public_path('uploads/user/'.$image->image);
            unlink($delete_form);
            User::onlyTrashed()->find($user_id)->forceDelete();
            return back(); 
        }
    }
    // all delete hardly

    function hard_all_delete(Request $request){
        if($request->click == 1){
            foreach($request->check as $user_check){
                User::onlyTrashed()->find($user_check)->restore();
            }

        }
        else{
            foreach($request->check as $user_check){
                $image = User::onlyTrashed()->find($user_check);
                if($image->image == null){
                     User::onlyTrashed()->find($user_check)->forceDelete();
                }
                else{
                $delete = public_path('uploads/user/'.$image->image);
                unlink($delete);
                User::onlyTrashed()->find($user_check)->forceDelete();
                }
            }  
        }

        return back();
  
    }


    //check box userlist
    function check_delete(Request $request){
        if($request->check == null){
            return back()->withNull('no select check');
        }else{
            foreach($request->check as $user_check){
                User::find($user_check)->delete();
            }
            return back();
        }

    }
 


    function profile_edit(){
        return view('admin.users.profile');
    }
   function profile_update(Request $request){
        if($request->password==''){
            User::find(Auth::id())->update([
                'name'=>$request->name,
                'email'=>$request->email,
            ]);
        }
        else{
            if(Hash::check($request->old_password, Auth::user()->password)){
                User::find(Auth::id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password),
                     ]);
                     return back()->withSuccess('profile updated!');
            }
            else{
                return back()->with('error', 'Incorrect password');
            }

        }
        return back();
   }

   function photo_update(Request $request){
    $request->validate([
        'photo'=>'required',
    ]);
    $uploaded_file = $request->photo;
    $extension = $uploaded_file -> getClientOriginalExtension();
    $file_name = Auth::id().'.'.$extension;
    Image::make($uploaded_file)->save(public_path('uploads/user/'.$file_name));
    User::find(Auth::id())->update([
        'image'=>$file_name,
    ]);
    return back();
   }

} 
