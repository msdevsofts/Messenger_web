@extends('web/common/layout')

@section('content')
    <div class="container message left">
        @include('web/message/list')
    </div>

    <div class="container message left">
        @include('web/message/talk')
    </div>
@endsection
