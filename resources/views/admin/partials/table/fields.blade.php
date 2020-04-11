@foreach($table['headers'] as $key => $row)
    <td>
        @if (isset($field[$row]))
            @if (!empty($table['data_types'][$row]))
                @switch($table['data_types'][$row])

                    {{-- Boolean: Yes / No  --}}
                    @case('boolean')
                        {{ $field[$row] == 1 || $field[$row] == true ? __('admin/general.yes') : __('admin/general.no') }}
                    @break

                    {{-- Name: object's name --}}
                    @case('name')
                        {{ $field[$row]->name }}
                    @break

                    {{-- Date --}}
                    @case('date')
                        {{ $field[$row]->diffForHumans() }}
                    @break

                    {{-- Image --}}
                    @case('image')
                        <img src="{{ getPublicPath() }}/images/{{ $field[$row]->path}}" alt="{{ $field->name }}" width="60">
                    @break

                    {{-- Switch: custom text depending from value --}}
                    @case('switch')
                        @if (!empty($table['options'][$row][$field[$row]]))
                            {{ $table['options'][$row][$field[$row]] }}
                        @else
                            {{ $field[$row] }}
                        @endif
                    @break
                @endswitch
            @else
                {{ $field[$row] }}
            @endif
        @endif
    </td>
@endforeach
