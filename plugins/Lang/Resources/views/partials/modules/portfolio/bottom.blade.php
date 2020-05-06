@foreach($langs as $lang)
    <div class="row">    
        <div class="form-group col-md-6 hide lang lang-{{ $lang->lang_tag }}" data-rel="intro">
            {!! Form::label('intro_'.$lang->lang_tag, 'Intro ['.$lang->lang_tag.']: ', ['class' => 'required']) !!}
            {!! Form::textarea('intro_'.$lang->lang_tag, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-md-6 hide lang lang-{{ $lang->lang_tag }}" data-rel="description">
            {!! Form::label('description_'.$lang->lang_tag, 'Description ['.$lang->lang_tag.']: ', ['class' => 'required']) !!}
            {!! Form::textarea('description_'.$lang->lang_tag, null, ['class' => 'form-control']) !!}
        </div>
    </div>
@endforeach