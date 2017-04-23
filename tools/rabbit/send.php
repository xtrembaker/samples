<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

/**
 * To use : php send.php -m"Your message"
 */
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false, false, new AMQPTable(array(
    "x-dead-letter-exchange" => "delayed"
)));

//$channel->exchange_declare('my-exchange', "x-delayed-message", true, false, new AMQPTable(array(
//    'x-delayed-type' => 'direct'
//)));

$headers = new AMQPTable(array("x-delay" => 15000));

$option = getopt("m:");

$msg = new AMQPMessage($option['m']);
$msg->set('application_headers', $headers);
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent ".$option['m']."\n";