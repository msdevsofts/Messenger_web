@extends('web/common/layout')

@section('content')
    <div class="prof">
        <a href="">
            <div id="prof_img" style="background-image: url('{{ asset(\App\System\Config\DefaultConfig::IMG_PROF) }}')"></div>
        </a>
    </div>

    <div>
        <p>
            <span class="text-120">ユニークID</span>
            {{ $uniqueId ?? '' }}
        </p>
        <p>
            <label for="nickname" class="text-120">ニックネーム</label>
            <span class="nickname">
                @if (empty($nickname))
                    <span class="text-smaller">{{ \App\System\Config\DefaultConfig::NICKNAME }}</span>
                @else
                    {{ $nickname }}
                @endif
            </span>
            <input type="hidden" name="nickname" id="nickname" class="nickname" value="{{ $nickname ?? '' }}" placeholder="ニックネーム">
            <span class="edit"><a href="">編集...</a></span>
        </p>
    </div>
@endsection
