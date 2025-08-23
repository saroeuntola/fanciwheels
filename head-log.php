<?php
// Path to logs folder
$csv_folder = './log/';
if (!is_dir($csv_folder)) mkdir($csv_folder, 0755, true);

$csv_file = __DIR__ . '/log/visitors.csv';

// Create file with header if it doesn't exist
if (!file_exists($csv_file)) {
    file_put_contents($csv_file, "Date,IP,Page,Referrer,User Agent\n");
}

// Get visitor info
$ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
$uri = $_SERVER['REQUEST_URI'] ?? '';
$referrer = $_SERVER['HTTP_REFERER'] ?? 'Direct';
$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$datetime = date("Y-m-d H:i:s");

// Append to CSV
$fields = [$datetime, $ip, $uri, $referrer, $user_agent];
$fp = fopen($csv_file, 'a');
if ($fp) {
    fputcsv($fp, $fields);
    fclose($fp);
}
?>
