<script src="{{asset('js/app.js')}}"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ $theme->getAsset('css/blocks.css') }}">
<link rel="stylesheet" href="{{ $theme->getAsset('css/theme.css') }}">

@if (!empty($css))
    <link rel="stylesheet" href="{{ $theme->getAsset('css/'.$css.'.css') }}">
@endif

<script src="{{getAsset('js/theme.js')}}" defer></script>
<script src="{{asset('assets/js/glide.min.js')}}" defer></script>
@stack('head')
