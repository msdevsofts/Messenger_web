<div class="container prof">
    <a href="/">
        <div class="left">
            <img src="{{ asset(\App\System\Config\DefaultConfig::IMG_PROF) }}" width="100px">
        </div>
        <div class="name left">
            <p>
                @if (empty($nickname))
                    <span class="text-smaller">{{ \App\System\Config\DefaultConfig::NICKNAME }}</span>
                @else
                    {{ $nickname }}
                @endif
            </p>
            <p>{{ $uniqueId ?? '' }}</p>
        </div>
    </a>
</div>

<div class="container menu">
    <ul>
        <li><a href="{{ route('contact') }}"><span class="icon_contacts">連絡先</span></a></li>
        <li><a href="{{ route('message.list') }}"><span class="icon_message">メッセージ</span></a></li>
        <li><a href="{{ route('contact.request') }}"><span class="icon_request">申請</span></a></li>
        <li><a href="{{ route('contact.request.recv') }}"><span class="icon_request_list">申請受信一覧</span></a></li>
    </ul>
</div>
