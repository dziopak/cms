@wrapper('admin.partials.widgets.widget_static', ['title' => 'Recently logged in users', 'id' => 'recently-logged-users', 'classes' => ''])
    <div class="hide-y-4">
        <ul class="list-group list-group-flush">
            @foreach($users as $user)
                <li class="list-group-item px-0">
                    <a class="text-primary" href="{{ route('admin.users.edit', $user->id) }}"><strong>{{ '@'.$user->name }}</strong></a> | {{$user->role->name}} | {{ $user->email }}
                </li>  
            @endforeach
        </ul>
    </div>

    <div class="show-y-4">
        Nie ma :D :D :D
    </div>

    <div class="widget-controls">
        <a class="btn btn-primary mt-4" href="{{ route('admin.users.index') }}">All users</a>
    </div>
@endwrapper
