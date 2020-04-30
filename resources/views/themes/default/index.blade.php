<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="{{asset('js/app.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ResponsiveSlides.js/1.55/responsiveslides.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;400;600;800&family=Raleway:wght@400;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ $theme->getAsset('css/theme.css') }}">
        <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/slick-theme.css')}}">
        <script src="{{asset('assets/js/slick.min.js')}}" defer></script>
        <title>{{ $site->full_title }}</title>
        @stack('head')
    </head>

    <body>

        @foreach($blocks as $row)
            <div class="block-row row">
                @foreach($row as $column)
                <div style="border: 1px solid #000; overflow: hidden;" class="block-col col-md-{{ $column['COLUMN_WIDTH'] }}">
                    @foreach($column['BLOCKS'] as $block)
                    @if ($block->type === 'module')
                    <div class="module">
                        @yield('module')
                    </div>
                    @else
                    @widget('front.'.$block['type'], ['block' => $block, 'position' => ['x' => $block->x, 'y' => $block->y, 'w' => $block->width, 'h' => $block->height]])
                            @endif

                        @endforeach
                    </div>
                @endforeach
            </div>
        @endforeach

        @stack('scripts-bottom')
    </body>

</html>
