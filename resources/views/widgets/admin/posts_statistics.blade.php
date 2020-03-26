@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
@endpush

@wrapper('admin.partials.widget_collapsable', ['id' => 'recent-logs', 'classes' => ''])
    <p>{{ __('admin/widgets/posts_statistics.created_within') }} {{ $config['days'] }} {{ trans_choice('admin/general.day', '2') }}</p>

    <canvas id="post_stats_chart" style="height: 100%; width: 100%;"></canvas>    

    <div class="widget-controls">
        <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">{{ __('admin/widgets/posts_statistics.new_post') }}</a>
        <a class="btn px-3" href="{{ route('admin.posts.index') }}">{{ __('admin/widgets/posts_statistics.more_stats') }}</a>
    </div>

@endwrapper

@push('scripts-bottom')
    <script>
        var ctx = $('#post_stats_chart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php echo $data['labels'] ?>],
                datasets: [{
                    label: ['{{ __('admin/widgets/posts_statistics.posts_per_day') }}'],
                    data: [<?php echo $data['values'] ?>],
                    backgroundColor: function(context) {
                        var index = context.dataIndex;
                        var value = context.dataset.data[index];
                        return value > 5 ? '#38c172' : '#3490dc'
                    },
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endpush