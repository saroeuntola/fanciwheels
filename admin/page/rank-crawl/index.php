<?php
include('../library/KeywordRank_lib.php');
include('../library/db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$rankBot = new KeywordRank();

// Handle AJAX Add Keyword
if (isset($_POST['action']) && $_POST['action'] === 'add_keyword') {
    $keyword = trim($_POST['new_keyword']);
    $siteURL = trim($_POST['site_url']);

    // Insert keyword
    $stmt = $rankBot->db->prepare("INSERT INTO keywords (keyword, site_url) VALUES (:keyword, :site_url)");
    $stmt->execute([
        ':keyword' => $keyword,
        ':site_url' => $siteURL
    ]);
    $keywordId = $rankBot->db->lastInsertId();

    // Crawl and remove old logs
    $rank = $rankBot->crawlKeyword($keyword, $siteURL);
    $stmt = $rankBot->db->prepare("DELETE FROM rank_logs WHERE keyword_id = :kid");
    $stmt->execute([':kid' => $keywordId]);

    $stmt = $rankBot->db->prepare("INSERT INTO rank_logs (keyword_id, rank_value, log_date) VALUES (:kid, :rank, NOW())");
    $stmt->execute([
        ':kid' => $keywordId,
        ':rank' => $rank
    ]);

    echo json_encode([
        'status' => 'success',
        'message' => "Keyword '{$keyword}' added and crawled successfully! Rank: {$rank}"
    ]);
    exit();
}

// Handle AJAX Crawl All
if (isset($_POST['action']) && $_POST['action'] === 'crawl_all') {
    $keywords = $rankBot->getKeywords();
    $status = [];
    foreach ($keywords as $kw) {
        // Remove old logs
        $stmt = $rankBot->db->prepare("DELETE FROM rank_logs WHERE keyword_id = :kid");
        $stmt->execute([':kid' => $kw['id']]);

        $rank = $rankBot->crawlKeyword($kw['keyword'], $kw['site_url']);

        $stmt = $rankBot->db->prepare("INSERT INTO rank_logs (keyword_id, rank_value, log_date) VALUES (:kid, :rank, NOW())");
        $stmt->execute([
            ':kid' => $kw['id'],
            ':rank' => $rank
        ]);

        $status[] = ['keyword' => $kw['keyword'], 'rank' => $rank];
    }

    echo json_encode(['status'=>'success', 'results'=>$status]);
    exit();
}

// Load keywords for initial display
$keywords = $rankBot->getKeywords();
?>
<!DOCTYPE html>
<html>
<head>
    <title>SEO Dashboard</title>
    <style>
        body { font-family: Arial; background:#f5f5f5; margin:0; padding:0;}
        .container { max-width:1000px; margin:30px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 6px 18px rgba(0,0,0,0.1);}
        h2 { text-align:center; color:#2c3e50; margin-bottom:20px; }
        button { padding:10px 15px; border:none; border-radius:6px; cursor:pointer; margin:5px; }
        .btn-add { background:#3498db; color:#fff; }
        .btn-add:hover { background:#2980b9; }
        .btn-crawl { background:#27ae60; color:#fff; }
        .btn-crawl:hover { background:#1e8449; }
        table { width:100%; border-collapse:collapse; margin-top:20px; }
        th, td { border:1px solid #ddd; padding:8px; text-align:center; }
        th { background:#3498db; color:#fff; }
        tr:nth-child(even) { background:#f9f9f9; }
        .popup { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; }
        .popup-content { background:#fff; padding:20px; border-radius:8px; width:400px; position:relative; }
        .close { position:absolute; top:10px; right:15px; cursor:pointer; font-weight:bold; font-size:18px; }
        .message { padding:10px; background:#dff0d8; color:#3c763d; border-radius:5px; margin-bottom:10px; display:none; }
        .status { margin-top:15px; padding:10px; background:#ecf0f1; border-radius:6px; max-height:200px; overflow-y:auto; }
    </style>
</head>
<body>
    <div class="container">
        <h2>SEO Dashboard</h2>

        <div id="ajaxMessage" class="message"></div>

        <!-- Buttons -->
        <div style="text-align:center;">
            <button class="btn-add" onclick="openPopup()">Add Keyword</button>
            <button class="btn-crawl" onclick="crawlAll()">Crawl All Keywords</button>
        </div>

        <!-- Rank Logs -->
        <div id="logsContainer">
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
    </div>

    <!-- Popup Form -->
    <div class="popup" id="popupForm">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h3>Add New Keyword</h3>
            <form id="addKeywordForm">
                <input type="text" name="new_keyword" placeholder="Keyword" required style="width:100%; margin-bottom:10px; padding:8px;">
                <input type="text" name="site_url" placeholder="Site URL (example.com)" required style="width:100%; margin-bottom:10px; padding:8px;">
                <button type="submit" style="width:100%; padding:10px; background:#3498db; color:#fff; border:none; border-radius:6px;">Add Keyword & Auto Crawl</button>
            </form>
        </div>
    </div>

    <script>
        function openPopup() { document.getElementById('popupForm').style.display='flex'; }
        function closePopup() { document.getElementById('popupForm').style.display='none'; }

        // Close popup when clicking outside
        window.onclick = function(event) {
            if(event.target == document.getElementById('popupForm')) closePopup();
        }

        // AJAX Add Keyword
        document.getElementById('addKeywordForm').addEventListener('submit', async function(e){
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action','add_keyword');

            const res = await fetch('', {method:'POST', body: formData});
            const data = await res.json();

            if(data.status === 'success'){
                const msgDiv = document.getElementById('ajaxMessage');
                msgDiv.innerHTML = data.message;
                msgDiv.style.display = 'block';
                closePopup();
                // Reload logs
                location.reload(); // simple approach to refresh table
            }
        });

        // AJAX Crawl All
        async function crawlAll(){
            const formData = new FormData();
            formData.append('action','crawl_all');

            const res = await fetch('', {method:'POST', body: formData});
            const data = await res.json();

            if(data.status === 'success'){
                const msgDiv = document.getElementById('ajaxMessage');
                msgDiv.innerHTML = 'Crawl completed!';
                msgDiv.style.display = 'block';
                location.reload(); // reload logs table
            }
        }
    </script>
</body>
</html>
