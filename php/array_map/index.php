<?php

$tab = [
	[
		'key' => 'key1'
	],
	[
		'key' => 'key2'
	],
];


$toto = array_map(function($element){return $element['key'] === 'key1';}, $tab);

var_dump($toto);