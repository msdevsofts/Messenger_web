@extends('web/common/layout')

@section('content')
    <div class="container contact_request clear">
        <div class="container">
            {{ Form::open([ 'url' => route('contact.request.search'), 'method' => 'post', 'class' => 'form-control' ]) }}
            {{ Form::token() }}

            {{ Form::text('name', old('name'), [ 'id' => 'name', 'class' => 'text-550', 'placeholder' => 'ユニークIDまたはニックネーム' ]) }}
            <span class="text-100">
                    {{ Form::Submit('検索', [ 'name' => 'search', 'class' => 'btn btn-primary form-control' ]) }}
                </span>

            {{ Form::close() }}
        </div>

        @if (empty($members))
            <div class="container">
                <p>申請可能なメンバーはいません。</p>
            </div>
        @else
            <div class="container">
                {{ Form::open([ 'url' => route('contact.request.send', [ 'id' => 0 ]), 'method' => 'post', 'id' => 'request' ]) }}
                {{ Form::token() }}

                <table>
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
            </div>
        @endif
    </div>
@endsection

@section('script')
@endsection
