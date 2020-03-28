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
        
                {{-- Display label if not a checkbox --}}
                @if($item['type'] !== 'checkbox')
                {!! Form::label($name, $item['label'].': ', ['class' => !empty($item['required']) && $item['required'] === true ? 'required' : '']) !!}
                @endif

                {{-- Display proper input type --}}
                @switch($item['type'])
                    
                    @case('text')
                        {!! Form::text($name, $item['value'], ['class' => 'form-control '.$item['class'], parseAttributes($item, 'attributes')]) !!}
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

                    @case('checkbox')
                        {!! Form::hidden($name, '0') !!}
                        {!! Form::checkbox($name, $item['checked_value'], $item['value'], ['class' => 'form-check-input '.$item['class'], parseAttributes($item, 'attributes')]) !!}
                        {!! Form::label($name, $item['label'], ['class' => 'form-check-label '.$item['class']]) !!}
                    @break

                @endswitch
            </div>
        @endforeach
    </div>
@endforeach