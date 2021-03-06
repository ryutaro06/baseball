@extends('layouts.admin')
@section('title', '野球観戦記事の編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>野球観戦記事の編集</h2>
                <form action="{{ action('Admin\NewsController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="title">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $topic_form->title }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="team">球団名</label>
                        <div class="col-md-10">
                            <select name="team" class="col-form-label">
                                <option value="{{ $topic_form->team }}">変更があれば選択してください</option>
                                <option value="giants">巨人</option>
                                <option value="tigers">阪神</option>
                                <option value="carp">広島</option>
                                <option value="dragons">中日</option>
                                <option value="baystars">DeNA</option>
                                <option value="swallows">ヤクルト</option>
                                <option value="hawks">ソフトバンク</option>
                                <option value="buffaloes">オリックス</option>
                                <option value="fighters">日本ハム</option>
                                <option value="lions">西武</option>
                                <option value="marines">ロッテ</option>
                                <option value="eagles">楽天</option>
                            </select>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label class="col-md-2" for="body">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ $topic_form->body }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $topic_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $topic_form->id }}">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($topic_form->histories != NULL)
                                @foreach ($topic_form->histories as $history)
                                    <li class="list-group-item">{{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection