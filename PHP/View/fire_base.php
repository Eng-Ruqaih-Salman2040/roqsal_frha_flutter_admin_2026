<?php
require 'vendor/autoload.php'; // مكتبة JWT

use Firebase\JWT\JWT;

// مسار ملف JSON الخاص بـ Firebase
$serviceAccountFile = __DIR__ . '/service-account1.json';
$serviceAccount = json_decode(file_get_contents($serviceAccountFile), true);

// العنوان والمحتوى من الفورم/الشاشة
$title = $_POST['title'] ?? 'farha';
$body = $_POST['note'] ?? 'Default Message';

// URL token Google OAuth2
$tokenUrl = "https://oauth2.googleapis.com/token";

// إنشاء JWT
$now = time();
$jwtHeader = ['alg' => 'RS256', 'typ' => 'JWT'];
$jwtClaim = [
    "iss" => $serviceAccount['client_email'],
    "scope" => "https://www.googleapis.com/auth/firebase.messaging",
    "aud" => $tokenUrl,
    "iat" => $now,
    "exp" => $now + 3600
];

// توليد JWT باستخدام المفتاح الخاص
$privateKey = $serviceAccount['private_key'];
$jwt = JWT::encode($jwtClaim, $privateKey, 'RS256');

// الحصول على Access Token من Google
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $tokenUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/x-www-form-urlencoded"]);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
    'assertion' => $jwt
]));
$response = curl_exec($ch);
curl_close($ch);

$tokenData = json_decode($response, true);
$accessToken = $tokenData['access_token'] ?? null;

if(!$accessToken){
    die("خطأ في الحصول على Access Token: " . $response);
}

// إعداد البيانات للإرسال
$fcmUrl = "https://fcm.googleapis.com/v1/projects/{$serviceAccount['project_id']}/messages:send";

$data = [
    "message" => [
        "topic" => "all", // أو استبدله بـ "token" لإرسال لجهاز محدد
        "notification" => [
            "title" => $title,
            "body" => $body
        ]
    ]
];

// إرسال الرسالة
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $fcmUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $accessToken",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$result = curl_exec($ch);
if(curl_errno($ch)){
    echo "cURL error: " . curl_error($ch);
}else{
    echo "تم الإرسال: " . $result;
}
curl_close($ch);
?>