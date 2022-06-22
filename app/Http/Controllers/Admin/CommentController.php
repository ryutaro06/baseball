<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Topic;
use App\Comment;
use Carbon\Carbon;
use Auth;

class CommentController extends Controller
{
    //
    
        public function comment_add()
    {
        return view('admin.baseball.index');    
    }
    
    public function comment_create(Request $request){

        // Varidationを行う
        // $this->validate($request, Comment::$rules);
        
        $comment = new Comment();
        $form = $request->all();
       
        
        $comment->fill($form);
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
        $comment->user_name = Auth::user()->name;
        $comment->edited_at = Carbon::now();
        $comment->save();
        
        return redirect('admin/baseball');
        
    }
}
