<?php

require 'vendor/autoload.php';

use Google\Client;



$serviceAccountFile = __DIR__ . '/service-account1.json';

$projectId = "farhanotification";
$title = "هذا الاشعار الاول";
$body  = "HI";

// توكن الجهاز من التطبيق
$deviceToken = "fD8qOaxZTpOk_dIy5JAhTT:APA91bHafP0Mtf3Z9IJORZZ65ytg_wn9fV72B7WegkSHfBAIxfFrYsFfF2etQ_Vb-3Tl-DSDlX6dis3z7yzjUYwpp5BOERHDHUDriVAolPFDYfSqAlfsNHA";


try {

    $client = new Client();
    $client->setAuthConfig($serviceAccountFile);
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

    $accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];


    $url = "https://fcm.googleapis.com/v1/projects/$projectId/messages:send";


    $data = [
        "message" => [
            "token" => $deviceToken,
            "notification" => [
                "title" => $title,
                "body"  => $body
            ],
            "data" => [
                "type" => "message"
            ]
        ]
    ];


    $headers = [
        "Authorization: Bearer " . $accessToken,
        "Content-Type: application/json"
    ];


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    curl_close($ch);

    echo $response;

} catch (Exception $e) {

    echo json_encode([
        "status" => false,
        "error" => $e->getMessage()
    ]);

}