<?php
require_once "../library/KeywordRank_lib.php";
require_once "../library/db.php";

$rankBot = new KeywordRank();

$keywords = $rankBot->getKeywords();

$allData = [];
foreach ($keywords as $kw) {
    $allData[] = [
        'id' => $kw['id'],
        'keyword' => $kw['keyword'],
        'logs' => $rankBot->getRankHistory($kw['id'])
    ];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Site Rank Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }
        .controls {
            text-align: center;
            margin-bottom: 20px;
        }
        select {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        canvas {
            background-color: #fafafa;
            border-radius: 8px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Site Rank Dashboard</h2>

        <div class="controls">
            <label for="keywordSelect">Select Keyword:</label>
            <select id="keywordSelect">
                <?php foreach ($allData as $data): ?>
                    <option value="<?= $data['id'] ?>"><?= htmlspecialchars($data['keyword']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <canvas id="rankChart" width="800" height="400"></canvas>
    </div>

    <script>
        let allData = <?= json_encode($allData) ?>;
        const ctx = document.getElementById('rankChart').getContext('2d');
        let chart;

        function renderChart(data) {
            const labels = data.logs.map(log => log.log_date);
            const ranks = data.logs.map(log => log.rank_value);

            if (chart) chart.destroy();

            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: data.keyword,
                        data: ranks,
                        borderColor: '#3498db',
                        backgroundColor: 'rgba(52, 152, 219, 0.2)',
                        fill: true,
                        tension: 0.3,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true, position: 'top' },
                        tooltip: { mode: 'index', intersect: false }
                    },
                    scales: {
                        y: {
                            reverse: true,
                            beginAtZero: false,
                            grid: { color: '#eee' },
                            title: { display: true, text: 'Rank' }
                        },
                        x: {
                            grid: { color: '#eee' },
                            title: { display: true, text: 'Date' }
                        }
                    }
                }
            });
        }

        function loadKeyword(keywordId) {
            const data = allData.find(k => k.id == keywordId);
            if (data) renderChart(data);
        }

        const select = document.getElementById('keywordSelect');
        loadKeyword(select.value);

        select.addEventListener('change', (e) => loadKeyword(e.target.value));

        // Auto-refresh every 5 minutes (300000 ms)
        setInterval(async () => {
            const response = await fetch(window.location.href);
            const htmlText = await response.text();

            const jsonMatch = htmlText.match(/let allData = (\[.*\]);/s);
            if (jsonMatch) {
                allData = JSON.parse(jsonMatch[1]);
                loadKeyword(select.value);
            }
        }, 300000);
    </script>
</body>
</html>
