@foreach($fields as $row)
    <div class="{{ $row['class'] }}">

        @if(!empty($row['label']))
            <span class="text-primary">{{ $row['label'] }}</span>
        @endif

        @foreach($row['items'] as $name => $item)
        
        @if($item['type'] !== "checkbox")
            <div class="col">
        @else
            <div class="form-check">
        @endif

            @if($item['type'] !== 'checkbox')
            {!! Form::label($name, $item['label'].': ', ['class' => !empty($item['required']) && $item['required'] === true ? 'required' : '']) !!}
            @endif

            @switch($item['type'])
                
                @case('text')
                    {!! Form::text($name, $item['value'], ['class' => 'form-control '.$item['class']]) !!}
                @break

                @case('password')
                    {!! Form::password($name, ['class' => 'form-control '.$item['class']]) !!}
                @break

                @case('email')
                    {!! Form::email($name, $item['value'], ['class' => 'form-control '.$item['class']]) !!}
                @break

                @case('select')
                    {!! Form::select($name, $item['options'], $item['value'], ['class' => 'form-control '.$item['class']]) !!}
                @break;

                @case('textarea')
                    {!! Form::textarea($name, $item['value'], ['class' => 'form-control '.$item['class']]) !!}
                @break;
                
                @case('file')
                    {!! Form::file($name, ['class' => 'form-control '.$item['class']]) !!}
                @break;

                @case('checkbox')
                    {!! Form::hidden($name, '0') !!}
                    {!! Form::checkbox($name, $item['checked_value'], $item['value'], ['class' => 'form-check-input '.$item['class']]) !!}
                    {!! Form::label($name, $item['label'], ['class' => 'form-check-label '.$item['class']]) !!}
                @break;

            @endswitch

        </div>
        @endforeach
    </div>
@endforeach