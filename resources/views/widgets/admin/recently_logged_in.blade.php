@wrapper('admin.partials.widget_collapsable', ['title' => 'Recently logged in users', 'id' => 'recently-logged-users', 'classes' => 'col-lg-8'])
    <ul class="list-group list-group-flush">
        @foreach($users as $user)
            <li class="list-group-item px-0">
                <a class="text-primary" href="{{ route('admin.users.edit', $user->id) }}"><strong>{{ '@'.$user->name }}</strong></a> | {{$user->role->name}} | {{ $user->email }}
            </li>  
        @endforeach
    </ul>
    <a class="btn btn-primary mt-4" href="{{ route('admin.users.index') }}">All users</a>
@endwrapper
