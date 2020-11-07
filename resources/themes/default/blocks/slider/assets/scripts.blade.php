<script>
    $(document).ready(function() {
        var Slider = new Glide('#slider-{{ $key }}', {
            type: 'slideshow',
            perView: 1,
            gap: 0,
            autoplay: {{ $block['autoplay'] * 1000 }}
        }).mount();
    });
</script>
