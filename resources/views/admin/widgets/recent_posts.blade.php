@wrapper('admin.partials.widgets.widget_static', ['title' => 'Recent posts', 'id' => 'recent-news', 'classes' => ''])
    @if (!empty($posts) && count($posts) > 0)
        <ul class="list-group list-group-flush w-100">
            @foreach($posts as $post)
                <li class="list-group-item px-0">
                    <a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->name }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <div style="display: flex; height: 100%; align-items: center;">
            <p style="text-align: center; width: 100%;"><strong>No posts to show.</strong></p>
        </div>
    @endif

    <div class="widget-controls w-100">
        <a class="btn btn-primary mr-2" href="{{ route('admin.posts.create') }}">{{ __('admin/widgets/recent_posts.write_new') }}</a>
        <a class="btn btn-transparent px-3" href="{{ route('admin.posts.index') }}">{{ __('admin/widgets/recent_posts.all_posts') }}</a>
    </div>
@endwrapper
