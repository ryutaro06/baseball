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
            <div class="col-md-8">
                <form action="{{ action('Admin\NewsController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        @foreach($posts as $topic)
            <div class="card main-content">
                <img src="{{ secure_asset('/storage/image/'. $topic->image_path) }}" class="card-img-top img_size" alt="{{$topic->image_path}}">
                <div class="card-body">
                    <div class="card-article">
                        <h3 class="card-title">{{ \Str::limit($topic->title, 100) }}</h3>
                        <p class="card-text">{{ \Str::limit($topic->body, 500) }}</p>
                    </div>
                    <!--Commentの実装-->
                    <div class="card-comment">
                        @foreach($topic->comments as $comment)
                            <div class="row">
                                <p class="card-text col-8">{{ \Str::limit($comment->comment, 50) }}</p>
                                <p class="card-text col-3">{{ $comment->edited_at }}</p>
                                <p class="card-text col-1">{{ $comment->user_name }}</p>
                            </div>
                        @endforeach
                    </div>
                    <form action="{{ action('Admin\CommentController@comment_create') }}" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-md-1" for="comment">
                                <div class="col-md-8">
                                    <input type="text" class="form-control comment-text" name="comment" placeholder="コメントの投稿">
                                </div>
                            </label>
                            @csrf
                            <input type="hidden" name="topic_id" value="{{$topic->id}}">
                            <input type="submit" class="btn btn-primary col-md-1" value="送信">
                            <div class="col-md-1 grid">
                                <a href="{{ action('Admin\NewsController@edit', ['id' => $topic->id]) }}">編集</a>
                                <a href="{{ action('Admin\NewsController@delete', ['id' => $topic->id]) }}">削除</a>
                            </div>
                        </div>
                    </form>

                    
                    <div class="row">
                        <div class="col-md-1">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    
@endsection