<script src="{{asset('js/app.js')}}"></script>
<script src="{{getAsset('js/theme.js')}}" defer></script>
<script src="{{asset('assets/js/glide.min.js')}}" defer></script>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/themes/default/blocks.css') }}">
<link rel="stylesheet" href="{{ asset('css/themes/default/theme.css') }}">

@if (!empty($css))
    <link rel="stylesheet" href="{{ asset('css/themes/default/'.$css.'.css') }}">
@endif

@laravelPWA
@stack('head')
