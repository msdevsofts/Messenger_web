@extends('web/common/layout')

@section('content')
    <div class="container contact_request clear">
        @if (empty($members))
            <p>申請可能なメンバーはいません。</p>
        @else
            {{ Form::open([ 'url' => route('contact.request.send'), 'method' => 'post' ]) }}
            {{ Form::token() }}

            <table>
                <thead>
                <tr>
                    <th></th>
                    <th>ニックネーム</th>
                    <th>申請</th>
                </tr>
                </thead>

                <tbody>
                @foreach($members as $member)
                    <tr>
                        <td>
                            <span class="prof_img" style="background-image: url('{{ asset(\App\System\Config\DefaultConfig::IMG_PROF) }}')"></span>
                        </td>
                        <td>{{ empty($member['nickname']) ? $member['unique_id'] : $member['nickname'] }}</td>
                        <td>{{ Form::Submit('申請', [ 'class' => 'btn btn-primary form-control', 'name' => 'request[' . $member['id'] . ']' ]) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ Form::close() }}
        @endif
    </div>
@endsection
