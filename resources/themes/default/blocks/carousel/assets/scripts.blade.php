<script>
    $(document).ready(function() {
        var Carousel = new Glide('#carousel-{{ $key }}', {
            type: 'carousel',
            startAt: 0,
            perView: 5,
            gap: 10,
            autoplay: {{ $block['autoplay'] * 1000 }}
        }).mount();
    });
</script>
