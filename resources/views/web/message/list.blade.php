<div class="container">
    <a href="" id="mew_message"><span class="list new">新規メッセージ作成</span></a>
</div>
@include('web/message/contact_popup')

@if (empty($list))
    <div class="container">
        <p>メッセージはありません。</p>
    </div>
@else
    @foreach($list as $talk)
        <div class="list talk">
            <a href="{{ route('message', [ 'id' => $talk['id'] ]) }}">
                <span class="prof_img talk_img clear left" style="background-image: url('{{ asset(\App\System\Config\DefaultConfig::IMG_PROF) }}')"></span>
                <p class="clear">
                    <span class="talk_name clear">{{ $talk['name'] }}</span>
                    <span class="">{{ $talk['message'] }}</span>
                </p>
            </a>
        </div>
    @endforeach
@endif
