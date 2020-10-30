<x-dashboard-widget :config="$config">
    <x-logs :data="$logs" />

    <div class="widget-controls">
        <a class="btn btn-primary" href="{{ route('admin.settings.logs.index') }}">
            {{ __('admin/widgets/recent_logs.all_logs') }}
        </a>
    </div>
</x-dashboard-widget>

