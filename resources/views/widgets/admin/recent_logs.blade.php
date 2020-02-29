@wrapper('admin.partials.widget_collapsable', ['title' => 'Recent actions', 'id' => 'recent-logs', 'classes' => 'col-lg-8'])
    @include('admin.partials.logs')
    <a class="btn btn-primary mt-4" href="{{ route('admin.settings.logs.index') }}">All action logs</a>
@endwrapper
