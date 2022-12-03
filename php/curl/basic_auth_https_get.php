<?php

$username = 'username';
$password = 'password';
$uri = "/v2.01/$username/clients/wallets?page=1";
$host = 'https://api.sandbox.mangopay.com';
$headers = [
    'Authorization: Basic ' . base64_encode($username.':'.$password),
    'Accept: */*'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $host.$uri);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // true to return the transfer as a string of the return value of curl_exec() instead of outputting it directly.
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

[
    'http_code' => $httpCode,
    'url' => $url
] = curl_getinfo($ch);

if($httpCode !== 200){
    var_dump(curl_getinfo($ch));
}

var_dump(json_decode($result, true));