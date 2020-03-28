@wrapper('admin.partials.widget_collapsable', ['id' => 'recent-logs', 'classes' => ''])
    <div class="pt-5">
        <canvas id="content_stats_chart" height="200" class="chart"></canvas>
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
                        backgroundColor: ['#3490dc', '#38c172', '#ff3939'],
                    }],

                    labels: [<?php echo $labels ?>]
                },
                options: {
                    legend: {
                        display: false,
                    },
                    layout: {
                    }
                }
            });
        });
    </script>
@endpush