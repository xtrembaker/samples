<?php

// List of all options: https://www.php.net/manual/en/function.curl-setopt.php

$ch = curl_init("http://www.google.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // true to return the transfer as a string of the return value of curl_exec() instead of outputting it directly.

$result = curl_exec($ch);

var_dump($result);
