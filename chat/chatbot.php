<?php
// chatbot.php

$apiKey = "AIzaSyA3LXARd-gsRCHkb6YmAz4a3oEi6mMdLIw";
$userMessage = $_POST['q'] ?? "Hello";

// Gemini API endpoint
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent";

$data = [
    "contents" => [[
        "parts" => [["text" => $userMessage]]
    ]]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "X-goog-api-key: $apiKey"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// SSL fix for localhost / shared server
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);


$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
    exit;
}

curl_close($ch);

$result = json_decode($response, true);

// Output only the bot’s text
if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    echo $result['candidates'][0]['content']['parts'][0]['text'];
} elseif (isset($result['error'])) {
    echo "API Error: " . $result['error']['message'];
} else {
    echo "Unexpected API response";
}
