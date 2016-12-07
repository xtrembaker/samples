<?php

$tab = [
	[
		'key' => 'key1'
	],
	[
		'key' => 'key2'
	],
];


$toto = array_filter($tab, function($element){return $element['key'] === 'key1';});

var_dump($toto);