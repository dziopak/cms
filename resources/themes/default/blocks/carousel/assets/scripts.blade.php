<script>
    $(document).ready(function() {
        var Carousel = new Glide('#carousel-{{ $key }}', {
            type: 'carousel',
            startAt: 4,
            perView: 5,
            gap: 10,
            autoplay: {{ $block['autoplay'] * 1000 }},
            breakpoints: {
                768: { perView: 1 },
                980: { perView: 3 },
            }
        }).mount();
    });
</script>
