<div class="app-card p-0">
    <div id="student-status-chart"></div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Example data: Replace with dynamic injection from backend if available
        const studentStatusData = [54, 21, 13, 7]; // Example values: active, graduated, on leave, dropped out
        const studentStatusLabels = [
            'Active', 'Graduated', 'On Leave', 'Dropped Out'
        ];

        const studentStatusOptions = {
            chart: {
                type: 'pie',
                height: 350,
                toolbar: { show: false },
                padding: 0
            },
            series: studentStatusData,
            labels: studentStatusLabels,
            colors: ['#10B981', '#3B82F6', '#F59E0B', '#EF4444'],
            legend: {
                show: false
            },
            dataLabels: {
                formatter: function(val, opts) {
                    return opts.w.globals.labels[opts.seriesIndex] + ": " + val.toFixed(0);
                }
            },
            tooltip: {
                y: {
                    formatter: function(val, opts) {
                        const status = opts.w.globals.labels[opts.seriesIndex];
                        return val + " students (" + status + ")";
                    }
                }
            },
            grid: {
                strokeDashArray: 3,
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                }
            }
        };

        var studentStatusChart = new ApexCharts(document.querySelector("#student-status-chart"), studentStatusOptions);
        studentStatusChart.render();
    </script>
</div>
