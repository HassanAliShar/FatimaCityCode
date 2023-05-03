<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function user_login(Request $request){
        $user = User::with('franchise')->where('email',$request->email)->where('password',sha1($request->password))->first();
        if($user){
            if($user->role_id == 1){
                session(['id'=>$user->id]);
                session(['email'=>$user->email]);
                session(['name'=>$user->name]);
                session(['status'=>$user->status]);
                session(['role_id' => $user->role_id]);

                return redirect('/admin/dashboard/');
            }
            else if($user->role_id == 2){
                if($user->franchise->total_amount >= $user->franchise->limit_amount){
                    return "Your limit has been completed please pay and admin will active you";
                }
                session(['id'=>$user->id]);
                session(['email'=>$user->email]);
                session(['name'=>$user->name]);
                session(['status'=>$user->status]);
                session(['role_id' => $user->role_id]);

                return redirect('/agent/dashboard/');
            }
        }
        else{
            $error = "Invalid Email Or Password";
            return view('auth.login',compact('error'));
        }

    }
}
