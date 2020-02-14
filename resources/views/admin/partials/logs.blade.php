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
            <p class="alert">
        @break;
    @endswitch

        {{ $log->author->name }} {{$log->message}} {{$log->target->name}} </p>
@endforeach