<?php

require "Node.php";


$node = new Node();

$connections = $node->getConnections();

var_dump($connections);
$connections[0]->setName('Arnaud');

var_dump($connections);
var_dump($node->getConnections());