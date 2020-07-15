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
                <span class="talk_img" style="background-image: url('{{ asset(\App\System\Config\DefaultConfig::IMG_PROF) }}')"></span>
                <span class="talk_name">{{ $talk['name'] }}</span>
                <p>{{ $talk['message'] }}</p>
            </a>
        </div>
    @endforeach
@endif
