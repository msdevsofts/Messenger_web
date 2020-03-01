<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Messenger</title>
    @include('web/common/stylesheet')
</head>
<body>

@include('web/common/nav')
<div class="container wrapper">
    @if (!empty(session('unique_id', '')))
        <div class="sidebar left">
        @include('web/common/left')
        </div>

        <div class="container left">
            @yield('content')
        </div>
    @else
        @yield('content')
    @endif
</div>

@include('web/common/scripts')

@yield('script')

</body>
</html>
