<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keputusan evotingEGMQGB</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Ensure the chart container is responsive */
        .chart-container {
            position: relative;
            margin: auto;
            height: 500px;
            width: 100%;
            max-width: 500px; /* Ensure the chart is not too wide on mobile */
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <canvas id="resultsChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('resultsChart').getContext('2d');
        const resultsChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Yes', 'No'],
                datasets: [{
                    label: 'Results',
                    data: [{{ $yesCount }}, {{ $noCount }}],
                    backgroundColor: ['#4CAF50', '#FF5252'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Keputusan evotingEGMQGB',
                        font: {
                            size: 18
                        },
                        padding: {
                            top: 10,
                            bottom: 30
                        }
                    },
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script>
</body>
</html>
