@foreach($fields as $row)
    <div class="{{ $row['class'] }}">

        {{-- Show label of inputs row --}}
        @if(!empty($row['label']))
            <span class="text-primary">{{ $row['label'] }}</span>
        @endif

        {{-- Show form inputs --}}
        @foreach($row['items'] as $name => $item)

            {{-- Input container --}}
            <div class="{{ $item['type'] === "checkbox" ? 'form-check' : 'col' }} {{ !empty($item['container_class']) ? $item['container_class'] : '' }}" data-container-for="{{ $name }}" {{ parseAttributes($item, 'container_attributes') }}
                @if (!empty($item['container_attributes']))
                    @foreach($item['container_attributes'] as $key => $row)
                    {{ $key.'='.$row.' ' }}
                    @endforeach
                @endif
            >

                {{-- Display label if not a checkbox or image --}}
                @if($item['type'] !== 'checkbox' && $item['type'] !== 'image')
                {!! Form::label($name, $item['label'].': ', ['class' => !empty($item['required']) && $item['required'] === true ? 'required' : '']) !!}
                @endif

                {{-- Display proper input type --}}
                @switch($item['type'])

                    @case('text')
                        {!! Form::text($name, $item['value'], ['class' => 'form-control '.$item['class'], parseAttributes($item, 'attributes'), !empty($item['disabled']) ? 'disabled' : '']) !!}
                    @break

                    @case('number')
                        {!! Form::number($name, $item['value'], ['class' => 'form-control '.$item['class'], parseAttributes($item, 'attributes'), !empty($item['disabled']) ? 'disabled' : '']) !!}
                    @break

                    @case('password')
                        {!! Form::password($name, ['class' => 'form-control '.$item['class'], parseAttributes($item, 'attributes')]) !!}
                    @break

                    @case('email')
                        {!! Form::email($name, $item['value'], ['class' => 'form-control '.$item['class'], parseAttributes($item, 'attributes')]) !!}
                    @break

                    @case('select')
                        {!! Form::select($name, $item['options'], $item['value'], ['class' => 'form-control '.$item['class'], parseAttributes($item, 'attributes')]) !!}
                    @break

                    @case('textarea')
                        {!! Form::textarea($name, $item['value'], ['class' => 'form-control '.$item['class'], parseAttributes($item, 'attributes')]) !!}
                    @break

                    @case('file')
                        {!! Form::file($name, ['class' => 'form-control '.$item['class'], parseAttributes($item, 'attributes')]) !!}
                    @break

                    @case('image')
                        <x-image-input :item="$item" :name="$name" :endpoint="$item['endpoint'] ?? ''" />
                    @break

                    @case('checkbox')
                        {!! Form::hidden($name, '0') !!}
                        {!! Form::checkbox($name, $item['checked_value'], $item['value'], ['class' => 'form-check-input '.$item['class'], parseAttributes($item, 'attributes')]) !!}
                        {!! Form::label($name, $item['label'], ['class' => 'form-check-label '.$item['class']]) !!}
                    @break

                @endswitch

            </div>
            @if (!empty($item['custom']))
                @switch($item['custom'])
                    @case('add-button')
                        <div class="col add-button-col"><button data-for="{{ $name }}" id="{{ $name.'-add' }}" class="add-button">+</button></div>
                    @break
                @endswitch
            @endif
        @endforeach
    </div>
@endforeach
