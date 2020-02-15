@if (count($logs) > 0)
    @foreach ($logs as $log)
        @switch($log->crud_action)
            @case(1)
                <p class="alert alert-success"
            @break
        
            @case(2)
                <p class="alert alert-warning"
            @break

            @case(3)
                <p class="alert alert-danger"
            @break
        
            @default
                <p class="alert alert-primary"
            @break;
        @endswitch

        data-crud="{{ $log->crud_action }}" data-type={{ $log->type }}>
        
        {{ '@'.$log->author->name }} {{$log->message}}
        {{$log->target && $log->target_id !== 0 ? $log->target->name : $log->target_name }}
    
        @endforeach
@else
    <p class="alert alert-secondary">No actions yet.</p>
@endif