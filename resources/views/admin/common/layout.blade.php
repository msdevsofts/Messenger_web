<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Messenger 管理画面</title>
    @include('admin/common/stylesheet')
</head>
<body>
@include('admin/common/nav')
<div class='container'>
    @yield('content')
</div>
</body>
</html>
