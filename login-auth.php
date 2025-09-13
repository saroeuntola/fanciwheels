<?php
session_start();
include('./admin/page/library/auth.php');
header('Content-Type: application/json');

$auth = new Auth();
$response = [
    'status' => false,
    'message' => 'Invalid username or password!',
    'redirect' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']) ? true : false;

    $loginResult = $auth->login($username, $password, $remember);

    if ($loginResult === true) {
        // Fetch role
        $result = dbSelect('users', 'role_id', "username=" . $auth->db->quote($username) . " LIMIT 1");
        if ($result && count($result) > 0) {
            $role = $result[0]['role_id'];
            if ($role === 1) $response['redirect'] = './admin';
            elseif ($role === 2) $response['redirect'] = './';
            elseif ($role === 3) $response['redirect'] = './admin/players_record';

            $response['status'] = true;
            $response['message'] = 'Login successful';
        }
    } elseif ($loginResult === 'inactive') {
        $response['status'] = false;
        $response['message'] = 'Your account is Blocked. Please Contact admin.';
    }
}

echo json_encode($response);
