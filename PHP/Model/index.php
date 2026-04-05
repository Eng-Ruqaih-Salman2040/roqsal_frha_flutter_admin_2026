<?php
require_once __DIR__ . '/vendor/autoload.php';
use Google\Client;

function getAccessToken(): string {
    $client = new Client();
    $client->setAuthConfig(__DIR__ . '/service-account1.json'); // ضع هنا مسار JSON من Firebase
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

    $token = $client->fetchAccessTokenWithAssertion();

    if (!isset($token['access_token'])) {
        die("خطأ: لم يتم الحصول على Access Token. تحقق من ملف service-account.json\n");
    }

    return $token['access_token'];
}

/**
 * إرسال إشعار FCM لأي FCM Token
 *
 * @param string $fcmToken توكن المستخدم
 * @param string $title عنوان الإشعار
 * @param string $body نص الإشعار
 * @return array استجابة FCM
 */
function sendNotification(string $fcmToken, string $title, string $body): array {
    $projectId = "farhanotification"; // ضع هنا Project ID الخاص بك في Firebase
    $url = "https://fcm.googleapis.com/v1/projects/$projectId/messages:send";

    $data = [
        "message" => [
            "token" => $fcmToken,
            "notification" => [
                "title" => $title,
                "body" => $body
            ]
        ]
    ];

    $headers = [
        "Authorization: Bearer " . getAccessToken(),
        "Content-Type: application/json"
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        die("Curl Error: " . curl_error($ch));
    }

    curl_close($ch);

    return json_decode($response, true);
}

// ----------------------
// مثال تجربة إرسال إشعار
// ----------------------
$fcmToken = "el9Np1E2RGSuuNuSKa7Fhs:APA91bHvGB2qE9BSStmqhD5iyVc91mYkF1bM-aNQsXq246oUPBD0ZsRLpbYQuBeYj2SHImNiA-Pszox0f2JZz_eSb-DMLw8WB1WHI5jz_edH_PV__-286OU"; // ضع هنا FCM Token الخاص بالمستخدم
$title    = "مرحبا!";
$body     = "تم إضافة درس جديد في تطبيقك.";

$result = sendNotification($fcmToken, $title, $body);

echo "استجابة FCM:\n";
print_r($result);