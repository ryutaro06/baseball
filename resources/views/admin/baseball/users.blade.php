@extends('layouts.admin')
@section('title', 'ユーザー編集画面')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザ編集</div>
                <div class="card-body">
                    <!-- 重要な箇所ここから -->
                    <form method="post" action="{{ action('Admin\UserController@postUserEdit', [$user->id]) }}">
                        @csrf
                        <p>ID：{{ $user->id }}</p>
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div>
                            <p>名前：
                                <input type="text" name="name" value="{{ $user->name }}" class="@error('name') is-invalid @enderror">
                            </p>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <p>好きな球団：
                                <select name="favorite_team" class="@error('favorite_team') is-invalid @enderror">
                                    <option value="{{ $user->favorite_team }}">{{ $user->favorite_team }}</option>
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
                                @error('favorite_team')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </p>
                        </div>
                        <div>
                            <p>メール：
                                <input type="text" name="email" value="{{ $user->email }}" class="@error('email') is-invalid @enderror">
                            </p>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <input type="submit" value="更新">
                    </form>
                    <!-- 重要な箇所ここまで -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection