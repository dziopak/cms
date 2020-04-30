@if ( !Auth::user() )

    <div class="px-3 py-4">
        {{ Form::open(['method' => 'POST', "url" => '/login', 'class' => 'w-100']) }}

        <div class="form-group">
            {{ Form::label('email', 'Email address:')}}
            {{ Form::text('email', null, ['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password:')}}
            {{ Form::password('password', ['class' => 'form-control'])}}
        </div>

        {{ Form::submit('Log in') }}
    </div>

@endif
