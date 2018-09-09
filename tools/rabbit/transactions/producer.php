<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__.'/../vendor/autoload.php';
require_once './../config.php';

$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS);
$channel = $connection->channel();

$channel->basic_qos(null, 100, null);

// ------- FIRST QUEUE
$queueName = 'first_queue';
$channel->queue_declare($queueName, false, true, false, false, false);

$properties = array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT);
$body = 'message 1';
$msg1 = new AMQPMessage($body, $properties);

$body = 'message 2';
$msg2 = new AMQPMessage($body, $properties);

//$channel->basic_publish($msg1, '', $queueName);

$channel->tx_select();
$channel->batch_basic_publish($msg1, '', $queueName);
$channel->batch_basic_publish($msg2, '', $queueName);

//$channel->basic_publish($msg1);

$channel->publish_batch();
$channel->tx_commit();