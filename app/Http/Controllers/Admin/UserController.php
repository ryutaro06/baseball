<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserEdited;

class UserController extends Controller
{
    //
    
    protected $user;
    
    /*
        コンストラクタ
    */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    /*
        画面表示、データー取得用
    */
    public function getEdit($id)
    {
        $user = $this->user->selectUserFindByld($id);
        return view('admin.baseball.users', compact('user'));
    }
}
