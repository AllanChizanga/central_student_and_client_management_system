<div class="container-fluid p-0">
    <div id="monthly-revenue-chart"></div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Example data: Replace with dynamic injection from backend if available
        const monthlyRevenueData = [12000, 15500, 14200, 21000, 19500, 18500, 22300, 23900, 21700, 22500, 23100, 24400];
        const monthCategories = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        const options = {
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { show: false },
                padding: 0 // remove default inner chart padding if present
            },
            series: [{
                name: 'Revenue',
                data: monthlyRevenueData
            }],
            xaxis: {
                categories: monthCategories,
                title: {
                    text: 'Month'
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

        var chart = new ApexCharts(document.querySelector("#monthly-revenue-chart"), options);
        chart.render();
    </script>
</div>