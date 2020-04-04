<div class="image-upload-container">
    {!! Form::file($name, ['class' => 'form-control image-upload', 'id' => $name, parseAttributes($item, 'attributes')]) !!}
    <img src="/{{ $item['value'] }}" id="{{ $name }}-image-preview" onclick="$('#{{ $name }}').trigger('click')" class="image-preview {{ $item['class'] }}">
    <button type="button" class="close position-absolute mt-1" style="right: 5px;" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
