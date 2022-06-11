<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Users extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user',['user'=>$user]);
    }
    public function changepassword(Request $request){
        $user = User::find($request->id);
        return $user;
       
    }

    //Sending AJAX user details from clicked every row
    public function changeDetails(Request $request){
        $user = User::find($request->id);
        return $user;
    }
    //Updating POP UP User Details  
    public function updateDetails(Request $request){
        $request->validate([
            'id'=>'required',
            'name'=>'required',
            'email'=>'required',
            'isadmin' =>'required',
        ]);
        $users= User::find($request->id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->isadmin = $request->is_admin;
        $users->save();
        return back();
    }

    public function updatePassword(Request $request){
        $request->validate([
            'first_password'=>'required',
            'second_password'=>'required',
        ]);
        if($request->first_password === $request->second_password){
            $users= User::find($request->id);
            $users->password = bcrypt($request->first_password);
            $users->save();
        }else{
            return redirect()->back()->withFail(['Password is not matching!! Try again']);     
        }
        return back();
    }

    public function addUser(Request $request){
        $request->validate([
            'name'=>'required', 'max:20',
            'email'=> 'required', 
        ]);
        $users= new User;
        $users->name= $request->name;
        $users->email=$request->email;
        $users->password=bcrypt($request->password);
        $users->isadmin= $request->is_admin;
        $users->save();
        return back()->with('success','New User Registered');
    }


}
