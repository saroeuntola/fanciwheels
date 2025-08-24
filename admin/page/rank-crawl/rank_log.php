<?php
require_once "../library/KeywordRank_lib.php";
require_once "../library/db.php";
$rankBot = new KeywordRank();

$keywords = $rankBot->getKeywords();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rank Logs</title>
    <style>
        body { font-family: Arial; background:#f5f5f5; margin:0; padding:0; }
        .container { max-width:900px; margin:50px auto; background:#fff; padding:30px; border-radius:10px; box-shadow:0 6px 18px rgba(0,0,0,0.1);}
        h2 { text-align:center; color:#2c3e50; margin-bottom:20px; }
        table { width:100%; border-collapse:collapse; margin-top:20px; }
        th, td { padding:10px; border:1px solid #ddd; text-align:center; }
        th { background:#3498db; color:#fff; }
        tr:nth-child(even) { background:#f9f9f9; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Keyword Rank Logs</h2>

        <?php foreach($keywords as $kw): ?>
            <h3><?= htmlspecialchars($kw['keyword']) ?> (<?= htmlspecialchars($kw['site_url']) ?>)</h3>
            <?php $logs = $rankBot->getRankHistory($kw['id']); ?>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Rank</th>
                </tr>
                <?php if(!empty($logs)): ?>
                    <?php foreach($logs as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['log_date']) ?></td>
                            <td><?= htmlspecialchars($log['rank_value']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="2">No rank logs found.</td></tr>
                <?php endif; ?>
            </table>
        <?php endforeach; ?>
    </div>
</body>
</html>
