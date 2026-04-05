<?php
require  __DIR__.'/../vendor/autoload.php';
use Google\Client;
function getAccessToken() {
    $client = new Client();
    $client->setAuthConfig(__DIR__ . '/service-account.json'); 
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

    $token = $client->fetchAccessTokenWithAssertion();

    return $token['access_token'];
}
?>