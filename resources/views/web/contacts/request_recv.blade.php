@extends('web/common/layout')

@section('content')
    @if (empty($members))
        <div class="container">
            <p>未処理の申請はありません。</p>
        </div>
    @else
        <div class="container contact_request">
            {{ Form::open([ 'url' => route('contact.request.update') ]) }}
            {{ Form::token() }}
            <table>
                @foreach($members as $member)
                    <tr>
                        <td>
                            <span class="prof_img" style="background-image: url('{{ asset(\App\System\Config\DefaultConfig::IMG_PROF) }}')"></span>
                        </td>
                        <td>{{ empty($member['nickname']) ? $member['unique_id'] : $member['nickname'] }}</td>
                        <td><span class="text-smaller text-150">{{ $member['requested_at'] }}</span></td>
                        <td>{{ Form::Submit('受け入れる', [ 'class' => 'btn btn-primary form-control', 'name' => 'accept[' . $member['id'] . ']' ]) }}</td>
                        <td>{{ Form::Submit('拒否', [ 'class' => 'btn btn-secondary form-control', 'name' => 'defuse[' . $member['id'] . ']' ]) }}</td>
                    </tr>
                @endforeach
            </table>
            {{ Form::close() }}
        </div>
    @endif
@endsection
