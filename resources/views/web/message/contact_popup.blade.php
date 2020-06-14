<dialog class="container message_contact modal clear">
    {{ Form::open([ 'url' => route('message.new'), 'method' => 'post' ]) }}
    {{ Form::token() }}
    <div class="container">
        <table>
            @foreach($contacts as $member)
                <tr>
                    <td><span class="prof_img" style="background-image: url('{{ asset(\App\System\Config\DefaultConfig::IMG_PROF) }}')"></span></td>
                    <td>
                        {{ Form::label('member[' . $member['id'] . ']', empty($member['nickname']) ? $member['unique_id'] : $member['nickname'], [ 'class' => 'text-smaller text-100per' ]) }}
                    </td>
                    <td>{{ Form::checkbox('member[]', $member['id'], false, [ 'class' => 'form-control', 'id' => 'member[' . $member['id'] . ']' ]) }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="container">
        <span class="text-100 left">{{ Form::button('閉じる', [ 'class' => 'form-control btn close' ]) }}</span>
        <span class="text-240 left">{{ Form::Submit('作成', [ 'class' => 'form-control btn btn-primary left' ]) }}</span>
    </div>
    {{ Form::close() }}
</dialog>
