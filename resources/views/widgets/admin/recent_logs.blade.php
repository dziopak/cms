@wrapper('admin.partials.widget_collapsable', ['title' => 'Recent actions', 'id' => 'recent-logs', 'classes' => ''])
    
    @include('admin.partials.logs')

    <div class="widget-controls">
        <a class="btn btn-primary" href="{{ route('admin.settings.logs.index') }}">All action logs</a>
    </div>

@endwrapper