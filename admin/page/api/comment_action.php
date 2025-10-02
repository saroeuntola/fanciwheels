<?php
session_start();
include "../library/db.php";

$action = $_POST['action'] ?? '';

if ($action === 'add_comment') {
    if (!isset($_SESSION['username'])) {
        echo "not_logged_in";
        exit;
    }

    $slug = $_POST['slug'];
    $username = $_SESSION['username']; 
    $comment = trim($_POST['comment']);

    if ($comment) {
        $stmt = $conn->prepare("INSERT INTO comments (game_slug, username, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $slug, $username, $comment);
        $stmt->execute();
        echo "success";
    }
}

if ($action === 'add_reply') {
    if (!isset($_SESSION['username'])) {
        echo "not_logged_in";
        exit;
    }

    $comment_id = (int)$_POST['comment_id'];
    $username = $_SESSION['username'];
    $reply = trim($_POST['reply']);

    if ($reply) {
        $stmt = $conn->prepare("INSERT INTO replies (comment_id, username, reply) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $comment_id, $username, $reply);
        $stmt->execute();
        echo "success";
    }
}
