
<div id="cl-analytics" class="cl-analytics">
    <div class="cl-chart">
        <canvas id="cl-chart" width="400" height="400"></canvas>
    </div>

    <script>
        var label = [<?php echo '"'.implode('","', $analytics_data['chart_data']['labels']).'"' ?>];
        var datasets_abandoned = [<?php echo '"'.implode('","', $analytics_data['chart_data']['abandoned']).'"' ?>];
        var datasets_recovered = [<?php echo '"'.implode('","', $analytics_data['chart_data']['recovered']).'"' ?>];
        
        var config = {
            type: 'line',
            data: {
                labels:label,
                datasets: [{
                    label: 'Abandoned',
                    backgroundColor: '#ee8033',
                    borderColor: '#ee8033',
                    data: datasets_abandoned,
                    fill: false,
                },{
                    label: 'Recovered',
                    backgroundColor: '#6d41d3',
                    borderColor: '#6d41d3',
                    data: datasets_recovered,
                    fill: false,
                }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Cart Overview',
                    fontSize: 18,
                    fontColor: '#363b4e',
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    bodySpacing: 12,
                    titleMarginBottom : 10,
                    xPadding : 7,
                    yPadding : 7,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            stepSize: 1
                        },
                        scaleLabel: {
                            display: true,
                        }
                    }]
                }
            }
        };
        var ctx = document.getElementById('cl-chart').getContext('2d');
        var cl_chart = new Chart(ctx, config);
    </script>
</div>
