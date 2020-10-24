<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>{{ isset($title) ? $title." - " : "" }}{{ $site->title }}</title>

@if (isset($meta_title))
    <meta name="title" content="{{ $meta_title }}">
@endif

@if (isset($meta_description))
    <meta name="description" content="{{ $meta_description }}">
@endif

@if (isset($meta_index) && $meta_index === 1)
    <meta name="robots" content="noindex" />
@endif

@stack('meta')
