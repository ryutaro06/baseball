<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
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
        
        // Varidationを行う
        $this->validate($request, User::$rules);
        
        
        $user = User::find($request->id);

        $user->name = $request->name;
        $user->favorite_team = $request->favorite_team;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
        $user->save();

        return redirect('admin/baseball');
    }
}
