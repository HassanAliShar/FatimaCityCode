<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create_user(Request $request){
        $register = new User();
        $register->name = $request->name;
        $register->email = $request->email;
        $register->password = sha1($request->password);
        $register->role_id = 1;
        $register->status = 0;

        if($register->save()){
            return redirect('login');
        }
    }
}
