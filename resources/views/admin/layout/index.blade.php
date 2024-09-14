<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - Chuyển đổi số Doanh nghiệp An Giang</title>
    <script src="{{ asset('assets/plugins/htmx/htmx.min.js') }}"></script>
</head>

<body>
    @yield('content')
</body>

</html>
