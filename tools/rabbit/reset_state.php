<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__.'/vendor/autoload.php';
require './config.php';

$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS);

$channel = $connection->channel();

$channel->queue_delete('first_queue');
$channel->queue_delete('second_queue');
$channel->queue_delete('third_queue');
$channel->queue_delete('fourth_queue');
$channel->queue_delete('fifth_queue');
$channel->queue_delete('notification');
$channel->queue_delete('delayed_notification');


$channel->exchange_delete('direct_exchange');