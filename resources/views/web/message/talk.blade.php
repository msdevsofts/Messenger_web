@if (($id ?? 0) > 0)
    <div id="messageList" class="container">
        @if (!empty($messages))
            @foreach($messages as $msg)
                <div class="message {{ $msg['member_id'] === $memberId ? 'self' : '' }}" id="id{{ $msg['id'] }}">
                    <span class="at">{{ $msg['created_at'] }}</span>
                    <p>{{ $msg['message'] }}</p>
                </div>
            @endforeach
        @endif
    </div>

    <div class="container">
        {{ Form::open([ 'url' => route('message.post', [ 'id' => $id ]), 'method' => 'post', 'class' => 'clear' ]) }}
        {{ Form::token() }}

        <span class="text-550 left">{{ Form::textarea('message', '', [ 'class' => 'awesome form-control', 'placeholder' => 'メッセージ', 'rows' => 1 ]) }}</span>
        <span class="text-120 submit left">{{ Form::submit('送信', [ 'class' => 'btn btn-primary form-control', 'name' => 'post' ]) }}</span>
        {{ Form::close() }}
    </div>
@endif
