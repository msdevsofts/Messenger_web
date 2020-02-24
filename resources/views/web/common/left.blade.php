<div class="sidebar">
    <div class="container prof">
        <div class="left">
            <img src="{{ asset('img/account_circle-24px.svg') }}" width="100px">
        </div>
        <div class="name left">
            <p>
                @if (empty($nickname))
                    <span class="text-smaller">ニックネーム未設定</span>
                @else
                    {{ $nickname }}
                @endif
            <p>{{ $uniqueId ?? '' }}</p>
        </div>
    </div>

    <div class="container menu">
        <ul>
            <li><a href=""><span class="icon_contacts">連絡先</span></a></li>
            <li><a href=""><span class="icon_message">メッセージ</span></a></li>
            <li><a href=""><span class="icon_request">申請</span></a></li>
        </ul>
    </div>
</div>
