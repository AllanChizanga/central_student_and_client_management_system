<div class="container-fluid p-0">
    <div class="app-card">
        <div id="quarterly-revenue-chart"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Example quarterly data: Replace with dynamic injection from backend if available
        const quarterlyRevenueData = [41700, 59000, 67400, 70000]; // Q1, Q2, Q3, Q4
        const quarterCategories = ['Q1', 'Q2', 'Q3', 'Q4'];

        const options = {
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { show: false },
                padding: 0 // remove default inner chart padding if present
            },
            series: [{
                name: 'Revenue',
                data: quarterlyRevenueData
            }],
            xaxis: {
                categories: quarterCategories,
                title: {
                    text: 'Quarter'
                }
            },
            yaxis: {
                title: {
                    text: 'Revenue ($)'
                },
                labels: {
                    formatter: function(value) {
                        return '$' + value.toLocaleString();
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return '$' + value.toLocaleString();
                    }
                }
            },
            colors: ['#4F46E5'],
            dataLabels: {
                enabled: false
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

        var chart = new ApexCharts(document.querySelector("#quarterly-revenue-chart"), options);
        chart.render();
    </script>
</div>