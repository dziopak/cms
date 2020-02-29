@wrapper('admin.partials.widget_collapsable', ['title' => 'Recent posts', 'id' => 'recent-news', 'classes' => 'col-lg-4'])
    <ul class="list-group list-group-flush">
        @foreach($posts as $post)
            <li class="list-group-item px-0">
                <a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->name }}</a>
            </li>  
        @endforeach
    </ul>
    <a class="btn btn-success mt-4 mr-2" href="{{ route('admin.posts.create') }}">Write new</a>
    <a class="btn btn-primary mt-4" href="{{ route('admin.posts.index') }}">All posts</a>
@endwrapper
