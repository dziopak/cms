@foreach($langs as $lang)
    <div class="form-group hide lang lang-{{ $lang->lang_tag }}" data-rel="content">
        {!! Form::textarea('content_'.$lang->lang_tag, null, ['class' => 'form-control tinymce']) !!}
    </div>
@endforeach