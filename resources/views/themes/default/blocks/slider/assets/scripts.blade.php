<script>
    $(document).ready(function() {
        $('#{{ $key }}.slider').slick({
            dots: {{ $block["controls"] ? 'true' : 'false' }},
            infinite: true,
            speed: 500,
            fade: true,
            autoplay: {{ $block["autoplay"] !== "0" ? 'true' : 'false' }},
            autoplaySpeed: {{ $block["autoplay"] }},
            cssEase: 'linear',
            arrows: {{ $block["controls"] ? 'true' : 'false' }}
        });
    });
</script>
