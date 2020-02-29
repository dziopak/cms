
{!! Form::open(['method' => 'POST', 'route' => 'admin.modules.lang.setlang', 'id' => 'lang-switcher-form', 'style' => 'display: inline;']) !!}
    {!! Form::select('lang', $langs, $current_lang, ['id' => 'lang-switcher']) !!}
    {!! Form::submit('Save') !!}
{{ Form::close() }}

<script>
    function setLang(lang) {
        if (lang !== "en") {
            $(".lang-"+lang).show();
            $(".lang-"+lang).each(function() {
                var rel = $(this).attr('data-rel');
                $("input[name='"+rel+"'], textarea[name='"+rel+"']").closest('.form-group').hide();
            });
        } else {
            $('.form-group').show();
            $(".lang").hide();
        }
    };

    $(document).ready(function () {
        var lang = $("#lang-switcher").val();
        setLang(lang);

        $("#lang-switcher").change(function() {
            var lang = $(this).val();
            setLang(lang);

            // TO DO //
            // $.post("{{ route('admin.modules.lang.setlang') }}", {"lang": lang});
            // SET LANG API CALL //

            
        });

    });
</script>