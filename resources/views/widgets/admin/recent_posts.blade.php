@wrapper('admin.partials.widget_collapsable', ['title' => 'Recent posts', 'id' => 'recent-news', 'classes' => ''])
    <ul class="list-group list-group-flush w-100">
        @foreach($posts as $post)
            <li class="list-group-item px-0">
                <a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->name }}</a>
            </li>  
        @endforeach
    </ul>
    <div class="widget-controls w-100">
        <a class="btn btn-success mr-2" href="{{ route('admin.posts.create') }}">Write new</a>
        <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">All posts</a>
    </div>
@endwrapper
