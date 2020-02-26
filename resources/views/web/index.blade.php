@extends('web/common/layout')

@section('content')
    <div class="prof">
        <a href="">
            <div id="prof_img" style="background-image: url('{{ asset(\App\System\Config\DefaultConfig::IMG_PROF) }}')"></div>
        </a>
    </div>

    <div>
        <div class="container border_bottom">
            <p class="clear no_spacing">
                <span class="text-120">ユニークID</span>
                {{ $uniqueId ?? '' }}
            </p>
        </div>
        <div class="container border_bottom">
            <p class="clear no_spacing">
                <label for="nickname" class="text-120 left">ニックネーム</label>
                <span class="nickname text-520 left text-smaller">
                    {{ empty($nickname) ? \App\System\Config\DefaultConfig::NICKNAME : $nickname }}
                </span>
                <input type="hidden" name="nickname" id="nickname" class="text-520 left" value="{{ $nickname ?? '' }}" placeholder="ニックネーム">
                <span class="edit left"><a href="">編集...</a></span>
            </p>
        </div>
        <div class="container border_bottom">
            <p class="clear no_spacing">
                <span class="text-120 left">パスワード</span>
                <span class="password left text-520 text-smaller">設定されたパスワード</span>
                <span class="left hide">
                    <span>
                        <input type="text" name="password" id="" class="text-520" placeholder="パスワード">
                        <input type="text" name="new_pw" id="" class="text-520" placeholder="新しいパスワード">
                        <input type="text" name="new_pw_confirm" class="text-520" id="新しいパスワード（確認）">
                    </span>
                </span>
                <span class="edit left"><a href="">編集...</a>
            </p>
        </div>
    </div>
@endsection
