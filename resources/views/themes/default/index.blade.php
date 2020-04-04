<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>{{ config('global.general.title') }}</title>
</head>
<body>
    <div class="container">
        @include($theme['url'] . '.partials.header')
        @yield('module')
        @include($theme['url'] . '.partials.footer')
    </div>
</body>
</html>
