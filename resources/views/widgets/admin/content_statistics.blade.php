@wrapper('admin.partials.widgets.widget_static', ['id' => 'recent-logs', 'classes' => ''])
    <div class="pt-5">
        <canvas id="content_stats_chart" width="200" style="margin: 0 auto; max-width: 320px; max-height: 80%;" class="chart"></canvas>
        
        <ul class="legend">
            <li><span class="legend-item" style="background-color: #227093"></span><br/><strong>{{ __('admin/widgets/content_statistics.posts') }}</strong>: {{ $raw['posts'] }}</li>
            <li><span class="legend-item" style="background-color: #34ace0"></span><br/><strong>{{ __('admin/widgets/content_statistics.pages') }}</strong>: {{ $raw['pages'] }}</li>
            <li><span class="legend-item" style="background-color: #706fd3"></span><br/><strong>{{ __('admin/widgets/content_statistics.users') }}</strong>: {{ $raw['users'] }}</li>
        </ul>
    </div>
@endwrapper


@push('scripts-bottom')
    <script>
        $(document).ready(function() {
            var ctx = $('#content_stats_chart');
            var myDoughnutChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [<?php echo $data ?>],
                        backgroundColor: ['#706fd3', '#34ace0', '#227093'],
                    }],

                    labels: [<?php echo $labels ?>]
                },
                options: {
                    legend: {
                        display: false,
                    }
                }
            });
        });
    </script>
@endpush