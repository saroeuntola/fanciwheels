<?php
include('./admin/page/library/auth.php');
header('Content-Type: application/json');
$userAuth = new Auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';
    $role_id = isset($_POST['role_id']) ? base64_decode($_POST['role_id']) : 2;

    $response = ['status' => false, 'message' => 'Unknown error'];

    try {
        // Attempt to register user
        $userAuth->register($username, $email, $phone, $password, $role_id);
        $response['status'] = true;
        $response['message'] = 'Registration successful';
    } catch (PDOException $e) {
        // Handle duplicate entries
        if ($e->getCode() == 23000) {
            if ($userAuth->exists('email', $email)) $response['message'] = 'Email already registered';
            elseif ($userAuth->exists('username', $username)) $response['message'] = 'Username already exists';
            elseif ($userAuth->exists('phone', $phone)) $response['message'] = 'Phone already used';
        } else {
            $response['message'] = $e->getMessage();
        }
    }

    echo json_encode($response);
    exit;
}
