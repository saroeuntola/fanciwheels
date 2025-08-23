<?php 
include "../admin/page/library/checkroles.php";
include('../admin/page/library/db.php');
protectPathAccess();
?>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

$csv_file = __DIR__ . '/../log/visitors.csv';

if (isset($_POST['delete_logs'])) {
    if (file_exists($csv_file)) {
       
        file_put_contents($csv_file, '');
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$rows = [];
if (file_exists($csv_file) && ($handle = fopen($csv_file, 'r')) !== false) {
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $rows[] = $data;
    }
    fclose($handle);
}

$rows = array_reverse($rows); // newest first
$total_visitors = count($rows); // Total visitor count
?>

<!DOCTYPE html>
<html>
<head>
    <title>Visitor Logs</title>
</head>
<body>
<h1>Visitor Logs</h1>

<p><strong>Total Visitors:</strong> <?= $total_visitors ?></p>

<form method="post" onsubmit="return confirm('Are you sure you want to delete all logs?');">
    <button type="submit" name="delete_logs">Delete All Logs</button>
</form>

<?php if (empty($rows)): ?>
    <p>No logs yet.</p>
<?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Date</th>
            <th>IP</th>
            <th>Page</th>
            <th>Referrer</th>
            <th>User Agent</th>
        </tr>
        <?php foreach ($rows as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r[0]) ?></td>
            <td><?= htmlspecialchars($r[1]) ?></td>
            <td><?= htmlspecialchars($r[2]) ?></td>
            <td><?= htmlspecialchars($r[3]) ?></td>
            <td><?= htmlspecialchars($r[4]) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
</body>
</html>
