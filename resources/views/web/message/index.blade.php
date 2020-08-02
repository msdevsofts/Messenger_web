@extends('web/common/layout')

@section('content')
    <div class="container message message_list left">
        @include('web/message/list')
    </div>

    <div class="message left">
        @include('web/message/talk')
    </div>
@endsection
