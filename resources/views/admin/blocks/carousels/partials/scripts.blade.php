<script>
    async function removeSlides(slides) {
        try {
            const response = await axios.post('{{ route("admin.blocks.carousels.detach", $carousel->id) }}', {
                'files': slides,
            });
            if (Array.isArray(response.data.slides)) {
                response.data.slides.forEach(el => {
                    $('.carousel-row[data-id="'+el+'"]').remove();
                });
            } else {
                $('.carousel-row[data-id="'+response.data.slides+'"]').remove();
            }
        } catch (error) {
            console.error(error);
        }
    }

    async function addSlides(slides) {
        try {
            const response = await axios.post('{{ route("admin.blocks.carousels.attach", $carousel->id) }}', {
                'files': slides,
            });
            console.log(response);
            if (Array.isArray(response.data.files)) {
                response.data.files.forEach(el => {
                    var html = `{!! view('admin.blocks.carousels.partials.image_data')->render() !!}`;
                    html = html.replace(/@@ID@@/g, el.id);
                    html = html.replace(/@@PATH@@/g, el.path);
                    $('#carousel-image-data').append(html);
                });
                $('#fade').fadeOut();
                $('.carousel-remove').click(function() {
                removeSlides($(this).attr('data-id'));
            });
            }
        } catch (error) {
            console.error(error);
        }
    }

    $('#slider-add-existing').click(function() {
        var slides = [];
        $("#media-list-form input[name^='mass_edit']:checked").each(function() {
            slides.push($(this).val());
        });
        console.log($('#media-list-form'));
        addSlides(slides);
    });

    $('.carousel-remove').click(function() {
        removeSlides($(this).attr('data-id'));
    });

    myDropzone.on("success", function($response) {
        addSlides([$response.xhr.response]);
    });
</script>
