<?php
header('Content-Type: application/json');
include_once '../library/db.php';

$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'en';

$phone = trim($_POST['phone'] ?? '');

$messages = [
    'en' => [
        'invalid' => 'Invalid phone number',
        'used' => 'This phone number has already been used!',
        'success' => 'Phone number saved successfully!'
    ],
    'bn' => [
        'invalid' => 'অবৈধ ফোন নম্বর',
        'used' => 'এই ফোন নম্বরটি ইতিমধ্যেই ব্যবহৃত হয়েছে!',
        'success' => 'ফোন নম্বর সফলভাবে সংরক্ষণ করা হয়েছে!'
    ]
];

$response = ['success' => false, 'message' => $messages[$lang]['invalid']];

if (preg_match('/^\+\d{8,20}$/', $phone)) {
    try {
        $db = dbConn();

        // Check for duplicate
        $stmt = $db->prepare("SELECT COUNT(*) FROM phone_records WHERE phone = :phone");
        $stmt->execute([':phone' => $phone]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $response['message'] = $messages[$lang]['used'];
        } else {
            // Insert new phone
            $stmt = $db->prepare("INSERT INTO phone_records (phone) VALUES (:phone)");
            $stmt->execute([':phone' => $phone]);
            $response = ['success' => true, 'message' => $messages[$lang]['success']];
        }
    } catch (Exception $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
}

echo json_encode($response);
