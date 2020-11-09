<!DOCTYPE html>
<html lang="en">
    <head>
        @include('Partial::meta')
        @include('Partial::head', ['css' => $css ?? null])
        @stack('scripts-top')
    </head>

    <body>
        @include('Partial::grid')
        @stack('scripts-bottom')
    </body>
</html>
