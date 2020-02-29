@foreach($langs as $lang)
    <div class="form-group row hide lang lang-{{ $lang->lang_tag }}" data-rel="meta_title">
        <div class="col">
            {!! Form::label('meta_title_'.$lang->lang_tag, 'Meta title: ') !!}
            {!! Form::text('meta_title_'.$lang->lang_tag, null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row hide lang lang-{{ $lang->lang_tag }}" data-rel="meta_description">
        <div class="col">
            {!! Form::label('meta_description_'.$lang->lang_tag, 'Meta description: ') !!}
            {!! Form::textarea('meta_description_'.$lang->lang_tag, null, ['class' => 'form-control']) !!}
        </div>
    </div>
@endforeach