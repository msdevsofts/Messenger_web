@extends('web/common/layout')

@section('content')
    @if (empty($contacts))
        <div class="container">
            <p>連絡先はありません。</p>
        </div>
    @else
        @foreach($contacts as $member)
            <div class="container contact">
                <a href="{{ route('contact.detail', [ 'id' => $member['target_id'] ]) }}">
                    <span class="prof_img" style="background-image: url('{{ asset(\App\System\Config\DefaultConfig::IMG_PROF) }}')">
                        {{ empty($member['nickname']) ? $member['unique_id'] : $member['nickname'] }}
                    </span>
                </a>
            </div>
        @endforeach
    @endif
@endsection
