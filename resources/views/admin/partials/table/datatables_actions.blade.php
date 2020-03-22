{{-- Display action button --}}
var $r = '';

@foreach($table['actions'] as $key => $row)
    $r += '<a class="btn btn-{{ $row['class'] }} mr-1" href="{{ route($row['url'], '__REPLACE__') }}">';
    
    @switch($key)


        @case('Edit')
        @case('edit')
            $r += '<i class="fa fas fa-edit"></i>';
        @break


        @case('Delete')
        @case('delete')
            $r += '<i class="fa fas fa-trash"></i>';
        @break


        @case('disable')
        @case('Disable')
            $r += '<i class="fa fas fa-minus-circle"></i>';
        @break


        @case('duplicate')
        @case('Duplicate')
            $r += '<i class="fa fas fa-minus-circle"></i>';
        @break


        @case('settings'):
        @case('Settings'):
            $r += '<i class="fa fas fa-cog"></i>';
        @break


        @case('control panel')
        @case('Control panel')
            $r += '<i class="fa fas fa-home"></i>';
        @break


    @endswitch

    $r += "</a>";
@endforeach
{{-- End --}}

return $r;