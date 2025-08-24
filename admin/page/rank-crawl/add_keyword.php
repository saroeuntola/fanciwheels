<?php
require_once "../library/KeywordRank_lib.php";
require_once "../library/db.php";
$rankBot = new KeywordRank();
$message = '';

if (isset($_POST['new_keyword']) && !empty(trim($_POST['new_keyword']))) {
    $keyword = trim($_POST['new_keyword']);
    $siteURL = trim($_POST['site_url']);
    
    // Add keyword to database
    $stmt = $rankBot->db->prepare("INSERT INTO keywords (keyword, site_url) VALUES (:keyword, :site_url)");
    $stmt->execute([
        ':keyword' => $keyword,
        ':site_url' => $siteURL
    ]);

    $message = "Keyword '{$keyword}' added successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Keyword</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; margin:0; padding:0; }
        .container { max-width: 600px; margin:50px auto; background: #fff; padding:30px; border-radius:10px; box-shadow:0 6px 18px rgba(0,0,0,0.1);}
        h2 { text-align:center; color:#2c3e50; }
        input[type=text], button { padding:8px 12px; border-radius:5px; border:1px solid #ccc; margin-bottom:10px; width:100%; }
        button { background:#3498db; color:#fff; border:none; cursor:pointer; }
        button:hover { background:#2980b9; }
        .message { padding:10px; background:#dff0d8; color:#3c763d; border-radius:5px; margin-bottom:10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Keyword</h2>
        <?php if($message): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="new_keyword" placeholder="Keyword" required>
            <input type="text" name="site_url" placeholder="Site URL (example.com)" required>
            <button type="submit">Add Keyword</button>
        </form>
    </div>
</body>
</html>
