@if (count($logs) > 0)
    @foreach ($logs as $log)
        @switch($log->crud_action)
            @case(1)
                <p class="alert alert-success">
            @break
        
            @case(2)
                <p class="alert alert-warning">
            @break

            @case(3)
                <p class="alert alert-danger">
            @break
        
            @default
                <p class="alert alert-primary">
            @break;
        @endswitch

            {{ '@'.$log->author->name }} {{$log->message}} {{'@'.$log->target->name}} </p>
    @endforeach
@else
    <p class="alert alert-secondary">No actions yet.</p>
@endif