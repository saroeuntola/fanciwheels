<?php
session_start();
header('Content-Type: application/json');

include_once '../library/players_lib.php';

$playerId = $_SESSION['player_id'] ?? null;

if (!$playerId) {
    echo json_encode(['success' => false, 'message' => 'Player not logged in']);
    exit;
}

$playerObj = new Player();
$player = $playerObj->getPlayerById($playerId);

if ($player) {
    echo json_encode(['success' => true, 'balance' => $player['balance']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Player not found']);
}
