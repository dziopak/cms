@wrapper('admin.partials.widget_collapsable', ['id' => 'recent-logs', 'classes' => ''])
    <p>{{ __('admin/widgets/posts_statistics.created_within') }} {{ $config['days'] }} {{ trans_choice('admin/general.day', '2') }}</p>

    <canvas id="post_stats_chart" class="chart" style="height: 100%; width: 100%;"></canvas>    

    <div class="widget-controls">
        <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">{{ __('admin/widgets/posts_statistics.new_post') }}</a>
        <a class="btn px-3" href="{{ route('admin.posts.index') }}">{{ __('admin/widgets/posts_statistics.more_stats') }}</a>
    </div>

@endwrapper

@push('scripts-bottom')
    <script>
        var ctx = $('#post_stats_chart');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php echo $data['labels'] ?>],
                datasets: [{
                    label: ['{{ __('admin/widgets/posts_statistics.posts_per_day') }}'],
                    data: [<?php echo $data['values'] ?>],
                    backgroundColor: ['rgba(52, 144, 220, 0.2)'],
                    pointBackgroundColor: function(context) {
                        var index = context.dataIndex;
                        var value = context.dataset.data[index];
                        if (value === 6) {
                            return '#3490dc'
                        } else {
                            return value > 5 ? '#38c172' : '#ff3939'
                        }

                    },
                    pointBorderWidth: 0,
                    pointRadius: 4,
                    borderWidth: 2,
                    borderColor: '#3490dc',
                    pointHoverRadius: 8,
                },
                {
                    label: ['Average'],
                    data: [6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6],
                    fill: false,
                    borderWidth: 1,
                    borderColor: 'rgba(33, 37, 41, 0.3)',
                    pointRadius: 0,
                    pointHoverRadius: 0,

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