@wrapper('admin.partials.widget_collapsable', ['id' => 'recent-logs', 'classes' => ''])
    
    @include('admin.partials.logs')

    <div class="widget-controls">
        <a class="btn btn-primary" href="{{ route('admin.settings.logs.index') }}">
            {{ __('admin/widgets/recent_logs.all_logs') }}
        </a>
    </div>

@endwrapper