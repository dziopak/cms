@foreach($langs as $lang)

    <div class="form-group row hide lang lang-{{ $lang->lang_tag }}" data-rel="author_title">
        <div class="col">
            {!! Form::label('author_title_'.$lang->lang_tag, 'Author\'s title '.$lang->lang_tag.': ', ['class' => 'required']) !!}
            {!! Form::text('author_title_'.$lang->lang_tag, null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row hide lang lang-{{ $lang->lang_tag }}" data-rel="content">
        <div class="col">
            {!! Form::label('content_'.$lang->lang_tag, 'Content '.$lang->lang_tag.': ', ['class' => 'required']) !!}
            {!! Form::textarea('content_'.$lang->lang_tag, null, ['class' => 'form-control']) !!}
        </div>
    </div>
@endforeach