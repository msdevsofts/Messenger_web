@extends('web/common/layout')

@section('content')
    <div class="prof">
        <div id="prof_img" style="background-image: url('{{ asset(\App\System\Config\DefaultConfig::IMG_PROF) }}')"></div>
    </div>

    <div class="prof">
        <div class="container border_bottom">
            <p class="clear no_spacing">
                <span class="text-120">ユニークID</span>
                {{ $detail['unique_id'] ?? '' }}
            </p>
        </div>
        <div class="container border_bottom">
            <p class="clear no_spacing">
                <label for="nickname" class="text-120 left">ニックネーム</label>
                <span class="nickname text-520 left text-smaller">
                    {{ empty($nickname) ? \App\System\Config\DefaultConfig::NICKNAME : $nickname }}
                </span>
            </p>
        </div>
        <div class="container border_bottom">
            <p class="clear no_spacing">
                <span class="text-120 left">性別</span>
                <span id="sex" class="text-520 left">{{ \App\Member::$sexList[$detail['sex']] }}</span>
            </p>
        </div>
    </div>
@endsection
