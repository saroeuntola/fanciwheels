<?php
include "../admin/page/library/protect-route.php";
include('../admin/page/library/phoneRecords_lib.php');

protectRouteAccess();  

$playerObj = new phoneRecords();
$players = $playerObj->getAll();

$filename = 'phones_records_' . date('Ymd') . '.xls';

// Send headers
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Phone</th><th>Created At</th></tr>";

foreach ($players as $player) {
    echo "<tr>";
    echo "<td>{$player['id']}</td>";
    echo "<td>{$player['phone']}</td>";
    echo "<td>" . date('Y/m/d', strtotime($player['created_at'])) . "</td>";
    echo "</tr>";
}

echo "</table>";
exit;



