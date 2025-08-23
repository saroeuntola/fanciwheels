<?php 
include "../admin/page/library/checkroles.php";
include('../admin/page/library/db.php');
protectPathAccess();  
?>

<?php
session_start();
$csv_file = '../log-visitor/visitors.csv';

// Read CSV
$rows = [];
if (file_exists($csv_file)) {
    if (($handle = fopen($csv_file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $rows[] = $data;
        }
        fclose($handle);
    }
}

// Reverse for newest first
$rows = array_reverse($rows);

// Search filter
$search = $_GET['search'] ?? '';
if ($search !== '') {
    $rows = array_filter($rows, function($row) use ($search) {
        return stripos(implode(' ', $row), $search) !== false;
    });
}

// Pagination
$per_page = 50;
$total = count($rows);
$page = max(1, (int)($_GET['page'] ?? 1));
$start = ($page - 1) * $per_page;
$pages = ceil($total / $per_page);
$rows = array_slice($rows, $start, $per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Visitor Logs Dashboard</title>
<style>
body { font-family: Arial; margin: 20px; }
table { border-collapse: collapse; width: 100%; margin-top: 10px; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
th { background-color: #f4f4f4; }
tr:nth-child(even) { background-color: #fafafa; }
.pagination { margin-top: 10px; }
.pagination a { margin: 0 5px; text-decoration: none; }
</style>
</head>
<body>

<h1>Visitor Logs</h1>

<form method="get" style="margin-bottom:10px;">
    <input type="text" name="search" placeholder="Search..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
</form>

<table>
<thead>
<tr>
<th>Date / Time</th>
<th>IP</th>
<th>Page</th>
<th>Referrer</th>
<th>User Agent</th>
</tr>
</thead>
<tbody>
<?php if (empty($rows)): ?>
<tr><td colspan="5">No records found.</td></tr>
<?php else: ?>
<?php foreach ($rows as $row): ?>
<tr>
<td><?= htmlspecialchars($row[0]) ?></td>
<td><?= htmlspecialchars($row[1]) ?></td>
<td><?= htmlspecialchars($row[2]) ?></td>
<td><?= htmlspecialchars($row[3]) ?></td>
<td><?= htmlspecialchars($row[4]) ?></td>
</tr>
<?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>

<div class="pagination">
<?php for ($i = 1; $i <= $pages; $i++): ?>
<a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>" <?= $i==$page?'style="font-weight:bold"':'' ?>><?= $i ?></a>
<?php endfor; ?>
</div>

</body>
</html>
