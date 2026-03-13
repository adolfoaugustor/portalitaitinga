<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Portal Itaitinga' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="public-shell">
    @yield('content')
</body>
</html>
