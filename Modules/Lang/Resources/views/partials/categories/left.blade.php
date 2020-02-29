@foreach($langs as $lang)
    
    <div class="form-group row hide lang lang-{{ $lang->lang_tag }}" data-rel="name">
        <div class="col">
            {!! Form::label('name_'.$lang->lang_tag, 'Category name: ', ['class' => 'required']) !!}
            {!! Form::text('name_'.$lang->lang_tag, null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row hide lang lang-{{ $lang->lang_tag }}" data-rel="slug">
        <div class="col">
            {!! Form::label('slug_'.$lang->lang_tag, 'Slug: ', ['class' => 'required']) !!}
            {!! Form::text('slug_'.$lang->lang_tag, null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row hide lang lang-{{ $lang->lang_tag }}" data-rel="description">
        <div class="col">
            {!! Form::label('description_'.$lang->lang_tag, 'Description: ') !!}
            {!! Form::textarea('description_'.$lang->lang_tag, null, ['class' => 'form-control']) !!}
        </div>
    </div>
@endforeach