@if (($id ?? 0) > 0)
    <div id="messageList" class="container left">
        @if (!empty($messages))
            @foreach($messages as $msg)
                <div class="message clear {{ $msg['member_id'] === $memberId ? 'self right' : 'other' }}" id="id{{ $msg['id'] }}">
                @if ($msg['member_id'] !== $memberId)
                    <span class="prof_img left"
                          style="background-image: url('{{ asset(\App\System\Config\DefaultConfig::IMG_PROF) }}')"></span>
                @endif
                    <div class="left">
                        <div class="clear" style="{{ $msg['member_id'] === $memberId ? '' : 'overflow: inherited' }}">
                            <span class="balloon {{ $msg['member_id'] === $memberId ? 'right' : '' }}">{{ $msg['message'] }}</span>
                        </div>
                        <div>
                            <span class="at">{{ $msg['created_at'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="container">
        {{ Form::open([ 'url' => route('message.post', [ 'id' => $id ]), 'method' => 'post', 'class' => 'clear' ]) }}
        {{ Form::token() }}

        <span class="text-340 left">{{ Form::textarea('message', '', [ 'class' => 'awesome form-control', 'placeholder' => 'メッセージ', 'rows' => 1 ]) }}</span>
        <span class="text-120 submit left">{{ Form::submit('送信', [ 'class' => 'btn btn-primary form-control', 'name' => 'post' ]) }}</span>
        {{ Form::close() }}
    </div>
@endif
