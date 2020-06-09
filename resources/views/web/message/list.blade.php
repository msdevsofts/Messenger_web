@if (empty($list))
    <div class="container">
        <p>メッセージはありません。</p>
    </div>
@else
    @foreach($list as $talk)
        <div class="list">
            <a href="{{ route('message', [ 'id' => $talk['id'] ]) }}">
                <span class="talk_img" style="background-image: url('{{ asset(\App\System\Config\DefaultConfig::IMG_PROF) }}')"></span>
                <span>{{ $talk['name'] }}</span>
                <p>{{ $talk['message'] }}</p>
            </a>
        </div>
    @endforeach
@endif
