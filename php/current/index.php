<?php

$tab = [
    'key1' => 'value1',
    'key2' => 'value2'
];

print_r(current($tab));
next($tab);
print_r(current($tab));

$tab = [
    'key1' => 'value1',
    'key2' => 'value2'
];

// Reset is called automatically when set new value
print_r(current($tab));
