@extends('admin/common/layout')

@section('content')
    管理画面
    <div id="login">
        {{ Form::open([ 'url' => route('login'), 'method' => 'post', 'class' => 'form-control' ]) }}

        <div>{{ Form::text('unique_id', old('unique_id'), [ 'class' => 'awesome form-control', 'placeholder' => 'ユニークID' ]) }}</div>
        <div>{{ Form::password('password', [ 'class' => 'awesome form-control', 'placeholder' => 'パスワード' ]) }}</div>

        <div class="error">{{ $error ?? '' }}</div>

        <div>{{ Form::Submit('ログイン', ['class' => 'btn btn-primary form-control']) }}</div>
        {{ Form::close() }}
    </div>
@endsection
