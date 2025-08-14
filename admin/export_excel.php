<?php
include "../admin/page/library/protect-route.php";
include('../admin/page/library/players_lib.php');

protectRouteAccess();  

$playerObj = new Player();
$players = $playerObj->getPlayers();

$filename = 'register_records_' . date('Ymd') . '.xls';

// Send headers
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Created At</th></tr>";

foreach ($players as $player) {
    echo "<tr>";
    echo "<td>{$player['id']}</td>";
    echo "<td>{$player['name']}</td>";
    echo "<td>{$player['phone']}</td>";
    echo "<td>{$player['gmail']}</td>";
    echo "<td>" . date('Y/m/d', strtotime($player['created_at'])) . "</td>";
    echo "</tr>";
}

echo "</table>";
exit;



