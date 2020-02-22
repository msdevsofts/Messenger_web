@extends('web/common/layout')

@section('content')
    <div id="login">
        {{ Form::open([ 'url' => route('login'), 'method' => 'post', 'class' => 'form-control' ]) }}
        {{ Form::token() }}

        <div>{{ Form::text('unique_id', old('unique_id'), [ 'class' => 'awesome form-control', 'placeholder' => 'ユニークID' ]) }}</div>
        <div>{{ Form::password('password', [ 'class' => 'awesome form-control', 'placeholder' => 'パスワード' ]) }}</div>
        <div class="pw_confirm {{ $isRegister ?? false ? '' : 'hide' }}">{{ Form::password('pw_confirm', [ 'class' => 'awesome form-control', 'placeholder' => 'パスワード確認用' ]) }}</div>

        <div class="error">{{ $error ?? '' }}</div>

        <div>{{ Form::Submit($isRegister ?? false ? '登録' : 'ログイン', ['class' => 'btn btn-primary form-control', 'name' => 'login']) }}</div>
        {{ Form::close() }}
        <p class="text-right"><span id="register" class="link">{{ $isRegister ?? false ? 'ログイン' : '登録' }}する</span></p>
    </div>
@endsection
