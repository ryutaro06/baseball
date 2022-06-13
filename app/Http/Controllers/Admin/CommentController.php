<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Topic;
use App\Comment;

class CommentController extends Controller
{
    //
    
        public function comment_add()
    {
        return view('admin.baseball.index');    
    }
    
    public function comment_create(Request $request){
        
        // Varidationを行う
        $this->validate($request, Comment::$rules);
        
        // Topic Modelからデータを取得する
        // $topic = Topic::find($request->id);
        
        $comment = new Comment();
        $form = $request->all();
        
        $comment->fill($form);
        // $comment->topic_id = $topic->id;
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
        $comment->save();
        
        return redirect('admin/baseball');
        
    }
}
