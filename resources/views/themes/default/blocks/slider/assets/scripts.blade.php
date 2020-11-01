<script>
    var glideConfig = {
        type: 'slideshow',
        perView: 1,
        gap: 0,
        autoplay: {{ $block['autoplay'] * 1000 }}
    };

    $(document).ready(function() {
        var Slider = new Glide('#slider-{{ $key }}', glideConfig).mount();
    });
</script>
