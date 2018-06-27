<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__.'/vendor/autoload.php';

$connection = new AMQPStreamConnection($host, $port, $user, $password);
$channel = $connection->channel();
$properties = array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT);
$body = json_encode(['accounts' => [['transactions' => [['value' => 10]]]]]);
$msg = new AMQPMessage($body, $properties);
$channel->basic_publish($msg, '');