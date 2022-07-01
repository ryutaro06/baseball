@extends('layouts.admin')
@section('title', '野球観戦記録')

@section('content')
    <div class="container">
        <div class="row">
            <h2>野球観戦記録</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\NewsController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8 text-right">
                <form action="{{ action('Admin\NewsController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="col-md-8">
            </div>
            <div class="col-md-4 text-right">
                <form action="{{ action('Admin\NewsController@index') }}" method="get">
                    {{ Form::select('cond_team', [
                        '' => '気になるチームを検索',
                        'giants' => '巨人',
                        'tigers' => '阪神',
                        'carp' => '広島',
                        'dragons' => '中日',
                        'baystars' => 'DeNA',
                        'swallows' => 'ヤクルト',
                        'hawks' => 'ソフトバンク',
                        'buffaloes' => 'オリックス',
                        'fighters' => '日本ハム',
                        'lions' => '西武',
                        'marines' => 'ロッテ',
                        'eagles' => '楽天',
                    ])}}
                    <input type="submit" class="btn btn-primary" value="検索">
                </form>
            </div>
            
        </div>
        
        
        
        @foreach($posts as $topic)
            <div class="card main-content row">
                <div class="info">
                    <img src="{{ secure_asset('/storage/image/'. $topic->image_path) }}" class="card-img-top img_size" alt="{{$topic->image_path}}">
                </div>
                <div class="info">
                    <div class="card-body">
                        <div class="card-article">
                            <h3 class="card-title">{{ \Str::limit($topic->title, 100) }}</h3>
                            <p class="card-text">{{ \Str::limit($topic->body, 500) }}</p>
                        </div>
                        <!--Commentの実装-->
                        <div class="card-comment">
                            @foreach($topic->comments as $comment)
                                <div class="row">
                                    <p class="card-text col-12">{{ \Str::limit($comment->comment, 50) }}</p>
                                    <p class="card-text col-3"></p>
                                    <p class="card-text col-6">{{ $comment->edited_at }}</p>
                                    <p class="card-text col-3">{{ $comment->user_name }}</p>
                                </div>
                            @endforeach
                        </div>
                        <form action="{{ action('Admin\CommentController@comment_create') }}" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-md-10" for="comment">
                                    <input type="text" class="form-control comment-text" name="comment" placeholder="コメントの投稿">
                                </label>
                                @csrf
                                <input type="hidden" name="topic_id" value="{{$topic->id}}">
                                <input type="submit" class="btn btn-primary col-md-2" value="送信">
                                <div class="col-md-9"></div>
                                <div class="col-md-3 grid">
                                    <a href="{{ action('Admin\NewsController@edit', ['id' => $topic->id]) }}">記事の編集</a>
                                    <a href="{{ action('Admin\NewsController@delete', ['id' => $topic->id]) }}">記事の削除</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    
@endsection