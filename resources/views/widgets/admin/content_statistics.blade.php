@wrapper('admin.partials.widgets.widget_static', ['id' => 'recent-logs', 'classes' => ''])
    <div class="pt-5">
        <canvas id="content_stats_chart" width="200" class="chart"></canvas>
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