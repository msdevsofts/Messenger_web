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
<div class='container'>
    @if (!empty(session('unique_id', '')))
        @include('web/common/left')
        <div class="container">
            @yield('content')
        </div>
    @else
        @yield('content')
    @endif
</div>
@include('web/common/scripts')
</body>
</html>
