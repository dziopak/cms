@foreach($table['headers'] as $key => $row)
    <td>
        @if (isset($field[$row]))
            @if (!empty($table['data_types'][$row]))
                @switch($table['data_types'][$row])
                    
                    @case('boolean')
                        {{ $field[$row] == 1 || $field[$row] == true ? __('admin/general.yes') : __('admin/general.no') }}
                    @break

                    @case('name')
                        {{ $field[$row]->name }}
                    @break

                    @case('date')
                        {{ $field[$row]->diffForHumans() }}
                    @break

                    @case('image')
                        <img src="{{ getPublicPath() }}/images/{{ $field[$row]->path}}" alt="{{ $field->name }}" width="60">
                    @break
                    
                @endswitch
            @else
                {{ $field[$row] }}
            @endif
        @endif
    </td>
@endforeach