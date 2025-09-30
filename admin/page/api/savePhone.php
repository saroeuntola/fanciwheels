<?php
header('Content-Type: application/json');
include_once '../library/db.php';

$phone = trim($_POST['phone'] ?? '');
$response = ['success' => false, 'message' => 'Invalid phone number'];

if (preg_match('/^\d{8,20}$/', $phone)) {
    try {
        $db = dbConn();

        // Check for duplicate
        $stmt = $db->prepare("SELECT COUNT(*) FROM phone_records WHERE phone = :phone");
        $stmt->execute([':phone' => $phone]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $response['message'] = 'This phone number has already been used!';
        } else {
            // Insert new phone
            $stmt = $db->prepare("INSERT INTO phone_records (phone) VALUES (:phone)");
            $stmt->execute([':phone' => $phone]);
            $response = ['success' => true, 'message' => 'Phone number saved successfully!'];
        }
    } catch (Exception $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
}

echo json_encode($response);
