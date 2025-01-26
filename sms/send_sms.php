<?php
header('Content-Type: application/json');

// Replace with your actual API access key and contact ID
$api_url = "https://sms.send.lk/api/v3/messages";
$access_key = "your_api_access_key";

// SMS details
$message_data = [
    "recipient" => "94763069615", // Replace with the recipient's phone number
    "message" => "Hello, this is a test message!", // Replace with your message content
    "sender_id" => "anil prasanna" // Replace with your registered sender ID
];

// Initialize cURL
$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $access_key",
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Handle response
if ($http_code === 200) {
    echo json_encode(["message" => "SMS sent successfully!"]);
} else {
    echo json_encode(["message" => "Failed to send SMS.", "response" => $response]);
}
?>
