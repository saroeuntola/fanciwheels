<?php
session_start();
header('Content-Type: application/json');

// Allowed domains
$allowed_origins = [
    "https://fanciwheel.com",
];

// Get the request origin or referer
$origin = $_SERVER['HTTP_ORIGIN'] ?? $_SERVER['HTTP_REFERER'] ?? '';

$allowed = false;
foreach ($allowed_origins as $allowed_origin) {
    if (strpos($origin, $allowed_origin) === 0) {
        $allowed = true;
        break;
    }
}

if (!$allowed) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Unauthorized - Invalid IP. Contact FancyWheel Developer for allowed IP']);
    exit;
}

// Get POST data
$name = $_POST['name'] ?? '';
$gmail = $_POST['gmail'] ?? '';
$phone = $_POST['phone'] ?? '';

if (!$name || !$gmail) {
    echo json_encode(['success' => false, 'message' => 'Name and Gmail are required']);
    exit;
}

include_once '../library/players_lib.php';
$playerObj = new Player();

if ($playerObj->getPlayerByGmail($gmail)) {
    echo json_encode(['success' => false, 'message' => 'Gmail already registered']);
    exit;
}

$created = $playerObj->createPlayer($name, $phone, $gmail);

if ($created) {
    $newPlayer = $playerObj->getPlayerByGmail($gmail);
    echo json_encode([
        'success' => true,
        'message' => 'Player created successfully',
        'player' => $newPlayer
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Player creation failed']);
}
