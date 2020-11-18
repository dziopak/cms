@php
    $style = $block['style'] ?? 'default';
    switch($block['align'] ?? 0) {
        case '0':
        default:
            $class = 'align-left';
        break;

        case '1':
            $class = 'align-right';
        break;

        case '2':
            $class = 'align-center';
        break;
    }
@endphp

@include('Theme::blocks.horizontal_menu.templates.'.$style)
