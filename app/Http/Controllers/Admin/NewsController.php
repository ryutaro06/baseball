<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 以下を追記することでTopic Modelが扱えるようになる
use App\Topic;

use Auth;

class NewsController extends Controller
{
    //
    
    public function add()
    {
        return view('admin.baseball.create');    
    }
    
    public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Topic::$rules);
        
        $topic = new Topic;
        $form = $request->all();
        
        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $topic->image_path = basename($path);
        } else {
            $topic->image_path = null;
        }
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);
        
        // データベースに保存する
        $topic->fill($form);
        $topic->user_id = Auth::id();
        $topic->save();
        
        // admmin/baseball/createにリダイレクトする
        return redirect('admin/baseball/create');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Topic::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Topic::all();
        }
        
        return view('admin.baseball.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function edit(Request $request)
    {
        $topic = Topic::find($request->id);
        if(empty($topic)) {
            abort(404);
        }
        return view('admin.baseball.edit', ['topic_form' => $topic]);
    }
    
    public function update(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Topic::$rules);
        
        // Topic Modelからデータを取得する
        $topic = Topic::find($request->id);
        // 送信されてきたフォームデータを格納する
        $topic_form = $request->all();
        if ($request->remove == 'true') {
          $topic_form['image_path'] = null;
        } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $topic_form['image_path'] = basename($path);
        } else {
          $topic_form['image_path'] = $topic->image_path;
        }
        
        unset($topic_form['image']);
        unset($topic_form['remove']);
        unset($topic_form['_token']);
        
        // 該当するデータを上書きして保存する
        $topic->fill($topic_form);
        $topic->save();
        return redirect('admin/baseball');
    }
    
    public function delete(Request $request)
    {
        // 該当するTopic Modelを取得
        $topic = Topic::find($request->id);
        
        // 削除する
        $topic->delete();
        return redirect('admin/baseball');
    }
}
