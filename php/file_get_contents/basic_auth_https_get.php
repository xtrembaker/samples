<?php

$username = 'username';
$password = 'password';
$uri = "/v2.01/$username/clients/wallets?page=1";
$host = 'https://api.sandbox.mangopay.com';
$headers = [
    'Authorization: Basic ' . base64_encode($username.':'.$password),
    'Accept: */*'
];

$context = [
    'http' => [
        'method' => 'GET',
        'header' => $headers
    ]
];

$json = file_get_contents($host.$uri, false, stream_context_create($context));
$wallets = json_decode($json, true);

foreach($wallets as $wallet){
    var_dump($wallet);
}