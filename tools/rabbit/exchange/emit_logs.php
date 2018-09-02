<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();


//$channel->exchange_declare('logs', 'fanout', false, false, false);
$channel->exchange_declare('logs', 'x-delayed-message', false, false, false, false, false, new \PhpAmqpLib\Wire\AMQPTable([
    "x-delayed-type" => "direct"
]));



$data = implode(' ', array_slice($argv, 1));
if(empty($data)) $data = "Coucou4";
$msg = new AMQPMessage($data);


$option = getopt("m:");

$headers = new AMQPTable(array("x-delay" => 5000));
$msg->set('application_headers', $headers);
$channel->basic_publish($msg, '', 'hello');

$channel->basic_publish($msg, 'logs');

echo " [x] Sent ", $data, "\n";

$channel->close();
$connection->close();

?>