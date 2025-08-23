<?php

$csv_file = './logs/visitors.csv'; 
$ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
$uri = $_SERVER['REQUEST_URI'] ?? '';
$referrer = $_SERVER['HTTP_REFERER'] ?? 'Direct';
$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$datetime = date("Y-m-d H:i:s");

$fields = [$datetime, $ip, $uri, $referrer, $user_agent];

$fp = fopen($csv_file, 'a');
if ($fp) {
    fputcsv($fp, $fields);
    fclose($fp);
}
?>