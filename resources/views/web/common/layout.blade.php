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
    @yield('content')
</div>
@include('web/common/scripts')
</body>
</html>
