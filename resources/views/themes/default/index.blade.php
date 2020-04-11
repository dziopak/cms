<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;400;600;800&family=Raleway:wght@400;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ $theme->getAsset('css/theme.css') }}">
        <title>{{ $site->full_title }}</title>
    </head>

    <body>

        <div class="grid">
            {{ $theme->boot($layout) }}
        </div>

        <div class="container">

        </div>
    </body>

</html>
