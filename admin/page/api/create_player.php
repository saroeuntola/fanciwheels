<?php
session_start();
header('Content-Type: application/json');

include_once '../library/players_lib.php';
include_once '../library/db.php';

$name = $_POST['name'] ?? '';
$gmail = $_POST['gmail'] ?? '';
$phone = $_POST['phone'] ?? '';

if (!$name || !$gmail) {
    echo json_encode(['success' => false, 'message' => 'Name and Gmail are required']);
    exit;
}

$playerObj = new Player();

// Check if player already exists
$existingPlayer = $playerObj->getPlayerByGmail($gmail);
if ($existingPlayer) {
    echo json_encode(['success' => false, 'message' => 'Email already registered']);
    exit;
}

$created = $playerObj->createPlayer($name, $phone, $gmail);

if ($created) {
    $newPlayer = $playerObj->getPlayerByGmail($gmail);
    if ($newPlayer) {
        $_SESSION['player_id'] = $newPlayer['id'];
        $_SESSION['player_name'] = $newPlayer['name'];
        $_SESSION['player_gmail'] = $newPlayer['gmail'];
        $_SESSION['player_balance'] = $newPlayer['balance'];

        echo json_encode([
            'success' => true,
            'message' => 'Player created successfully',
            'player' => $newPlayer,
        ]);
        exit;
    }
    echo json_encode(['success' => false, 'message' => 'Failed to retrieve player info']);
} else {
    echo json_encode(['success' => false, 'message' => 'Player creation failed']);
}
