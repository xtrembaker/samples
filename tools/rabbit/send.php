<?php
require_once __DIR__     . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

/**
 * To use : php send.php -m"Your message"
 */
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('main_queue');

/**
 * The core idea in the messaging model in RabbitMQ is that the producer never sends any messages directly to a queue. Actually, quite often the producer doesn't even know if a message will be delivered to any queue at all.
 * Instead, the producer can only send messages to an exchange.
 */
$channel->exchange_declare('main_exchange', "x-delayed-message", true, false, new AMQPTable(array(
    'x-delayed-type' => 'direct'
)));

$channel->queue_declare('delayed_queue', false, false, false, false, false, new AMQPTable(array(
    "x-dead-letter-exchange" => "delayed"
)));


$headers = new AMQPTable(array("x-delay" => 15000));

$option = getopt("m:");

$msg = new AMQPMessage($option['m']);
$msg->set('application_headers', $headers);
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent ".$option['m']."\n";