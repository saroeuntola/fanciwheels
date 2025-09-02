<?php

$allowed_hosts = ['fanciwheel.com', 'www.fanciwheel.com', 'localhost', '127.0.0.1', 'fancywheel:8080'];

$host = $_SERVER['HTTP_HOST'] ?? '';
if (!in_array($host, $allowed_hosts)) {
    http_response_code(403);
    exit('Forbidden');
}

$js_file = basename($_GET['file'] ?? '');
$js_path = __DIR__ . '/js/' . $js_file;

if (!file_exists($js_path)) {
    http_response_code(404);
    exit('File not found');
}

header('Content-Type: application/javascript');
readfile($js_path);
exit;
