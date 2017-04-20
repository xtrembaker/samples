<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * To use : php send.php -m"Your message"
 */
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello');

$option = getopt("m:");

$msg = new AMQPMessage($option['m']);
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent ".$option['m']."\n";