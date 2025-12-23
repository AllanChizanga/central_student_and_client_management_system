<div class="p-0">
    <div id="project-status-chart"></div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
      // Project status pie chart options
      const projectStatusOptions = {
        chart: {
            type: 'pie',
            height: 350
        },
        series: [12, 7, 4, 1], // Example values: completed, in progress, on hold, cancelled
        labels: ['Completed', 'In Progress', 'On Hold', 'Cancelled'],
        colors: ['#10B981', '#3B82F6', '#F59E0B', '#EF4444'],
        legend: {
            position: 'bottom'
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
                    return val + " projects (" + status + ")";
                }
            }
        }
      };

      const projectStatusChart = new ApexCharts(document.querySelector("#project-status-chart"), projectStatusOptions);
      projectStatusChart.render();
    </script>
</div>
