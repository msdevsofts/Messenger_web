@extends('web/common/layout')

@section('content')
    {{ Form::open([ 'url' => route('prof.update'), 'method' => 'post' ]) }}
    {{ Form::token() }}
        <div class="prof">
            <a href="">
                <div id="prof_img" style="background-image: url('{{ asset(\App\System\Config\DefaultConfig::IMG_PROF) }}')"></div>
            </a>
        </div>

        <div class="prof">
            <div class="container border_bottom">
                <p class="clear no_spacing">
                    <span class="text-120">ユニークID</span>
                    {{ $uniqueId ?? '' }}
                </p>
            </div>
            <div class="container border_bottom nickname">
                <p class="clear no_spacing">
                    <label for="nickname" class="text-120 left">ニックネーム</label>
                    <span class="nickname text-520 left text-smaller">
                        {{ empty($nickname) ? \App\System\Config\DefaultConfig::NICKNAME : $nickname }}
                    </span>
                    {{ Form::hidden('nickname', old('nickname') ?? $nickname ?? '', [ 'id' => 'nickname', 'class' => 'text-520 left', 'placeholder' => 'ニックネーム' ]) }}
                    <span class="edit left"><a href="">編集...</a></span>
                </p>
            </div>
            <div class="container border_bottom password">
                <p class="clear no_spacing">
                    <span class="text-120 left">パスワード</span>
                    <span class="password left text-520 text-smaller">設定されたパスワード</span>
                    <span id="password" class="left hide">
                        {{ Form::password('password', [ 'class' => 'text-520', 'placeholder' => 'パスワード' ]) }}
                        {{ Form::password('new_pw', [ 'class' => 'text-520', 'placeholder' => '新しいパスワード' ]) }}
                        {{ Form::password('new_pw_confirm', [ 'class' => 'text-520', 'placeholder' => '新しいパスワード（確認）' ]) }}
                    </span>
                    <span class="edit left"><a href="">編集...</a></span>
                </p>
            </div>
            <div class="container border_bottom">
                <p class="clear no_spacing">
                    <label for="privacy" class="text-120 left">プライバシー</label>
                    <span class="text-520 left">
                        <label>{{ Form::checkbox('privacy', 1, $isDenySearch ?? false, [ 'id' => 'privacy', 'class' => 'privacy' ]) }}IDによる連絡先追加を拒否</label>
                    </span>
                </p>
            </div>

            <div class="container">
                {{ Form::Reset('リセット', [ 'class' => 'btn btn-secondary form-control left' ]) }}
                {{ Form::Submit('更新', [ 'class' => 'btn btn-primary form-control left', 'name' => 'update' ]) }}
            </div>
        </div>
    {{ Form::close() }}
@endsection
