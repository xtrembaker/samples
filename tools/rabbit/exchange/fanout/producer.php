<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__.'/../../vendor/autoload.php';
require_once './../../config.php';

$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS);
$channel = $connection->channel();
$channel->exchange_declare('fanout_exchange', 'fanout');

// ------- FIRST QUEUE
$queueName = 'first_queue';
$passive = false;//what's this ?
$durable = true;
$exclusive = false; // we don't want the queue to be accessed only by the current connection
$autoDelete = false; // we don't want the queue to be delete once the connection closes
$noWait = false; //what's this ?
$channel->queue_declare($queueName, $passive, $durable, $exclusive, $autoDelete, $noWait);
$channel->queue_bind($queueName, 'fanout_exchange');

// ------- SECOND QUEUE
$queueName = 'second_queue';
$passive = false;//what's this ?
$durable = true;
$exclusive = false; // we don't want the queue to be accessed only by the current connection
$autoDelete = false; // we don't want the queue to be delete once the connection closes
$noWait = false; //what's this ?
$channel->queue_declare($queueName, $passive, $durable, $exclusive, $autoDelete, $noWait);
$channel->queue_bind($queueName, 'fanout_exchange');

// ------- THIRD QUEUE
$queueName = 'third_queue';
$passive = false;//what's this ?
$durable = true;
$exclusive = false; // we don't want the queue to be accessed only by the current connection
$autoDelete = false; // we don't want the queue to be delete once the connection closes
$noWait = false; //what's this ?
$channel->queue_declare($queueName, $passive, $durable, $exclusive, $autoDelete, $noWait);
$channel->queue_bind($queueName, 'fanout_exchange');

$properties = array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT);
$body = json_encode(['accounts' => [['transactions' => [['value' => time()]]]]]);
$msg = new AMQPMessage($body, $properties);
$channel->basic_publish($msg, 'fanout_exchange');
