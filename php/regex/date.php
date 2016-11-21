<?php

$date = '2012-11-08';
$pattern = '/\d{4}-\d{2}-\d{2}/';

preg_match($pattern, $date, $matches);

var_dump($matches);