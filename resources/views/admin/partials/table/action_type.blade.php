@switch($key)
    @case('Edit')
    @case('edit')
        <i class="fa fas fa-edit"></i>
    @break

    @case('Delete')
    @case('delete')
        <i class="fa fas fa-trash"></i>
    @break


    @case('disable')
    @case('Disable')
        <i class="fa fas fa-minus-circle"></i>
    @break;

    @case('duplicate')
    @case('Duplicate')
        <i class="fa fas fa-copy"></i>
    @break;

    @case('settings')
    @case('Settings')
        <i class="fa fas fa-cog"></i>
    @break;

    @case('control panel')
    @case('Control panel')
        <i class="fa fas fa-home"></i>
    @break;
        
    @default
        {{ $key }}
    @break
@endswitch