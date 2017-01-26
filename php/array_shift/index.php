<?php

$tab = [
    'password' => '123456',
    'login' => 'toto'
];

$val = array_shift($tab);

print_r($val);
print_r($tab);