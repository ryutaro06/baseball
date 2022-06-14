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
                    <h5 class="card-title">{{ \Str::limit($topic->title, 100) }}</h5>
                    <p class="card-text">{{ \Str::limit($topic->body, 150) }}</p>
                    <!--Commentの実装-->
                    @foreach($topic->comments as $comment)
                        <p class="card-text">{{ \Str::limit($comment->comment, 150) }}</p>
                    @endforeach
                    <form action="{{ action('Admin\CommentController@comment_create') }}" method="post" enctype="multipart/form-data">
                    
                        <div class="form-group row">
                            <label class="col-md-2" for="comment">コメント</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="comment">
                            </div>
                        </div>
                        @csrf
                        <input type="hidden" name="topic_id" value="{{$topic->id}}">
                        <input type="submit" class="btn btn-primary" value="送信">
                    </form>

                    
                    <div class="row">
                        <div class="col-1">
                            <a href="{{ action('Admin\NewsController@edit', ['id' => $topic->id]) }}">編集</a>
                        </div>
                        <div class="col-1">
                            <a href="{{ action('Admin\NewsController@delete', ['id' => $topic->id]) }}">削除</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    
@endsection