@wrapper('admin.partials.widget_collapsable', ['title' => 'Recent posts', 'id' => 'recent-news', 'classes' => ''])
    <ul class="list-group list-group-flush">
        @foreach($posts as $post)
            <li class="list-group-item px-0">
                <a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->name }}</a>
            </li>  
        @endforeach
    </ul>
    <a class="btn btn-primary mt-4" href="{{ route('admin.posts.index') }}">All posts</a>
@endwrapper
