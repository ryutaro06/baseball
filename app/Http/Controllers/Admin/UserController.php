<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function getUserEdit(Request $request)
    {
        $user = User::find($request->id);
        
        return view('admin.baseball.users', compact('user'));
    }
    
    public function postUserEdit(Request $request)
    {
        
        $user = User::find($request->id);
        $user_form = $request->all();
        $user->fill($user_form);
        $user->save();
        // echo $user;
        // exit;
      
        // return view('admin.baseball.users', ['user' => $user]);  
        return redirect('admin/baseball');
    }
}
