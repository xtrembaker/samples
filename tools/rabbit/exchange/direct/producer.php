<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__.'/../../vendor/autoload.php';
require_once './../../config.php';

$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS);
$channel = $connection->channel();
$exchangeName = 'direct_exchange';
$exchangeType = 'direct'; //may be empty (=direct)
$passive = false; //server will reply with Declare-Ok if the exchange already exists with the same name, and raise an error if not
$durable = true; //durable exchanges remain active when a server restarts.
$autoDelete = false; //if set, exchange is deleted when all queues have finished using it.
$internal = false;//If set, the exchange may not be used directly by publishers, but only when bound to other exchanges
$noWait = false; //If set, the server will not respond to the method
$channel->exchange_declare($exchangeName, $exchangeType, $passive, $durable, $autoDelete, $internal, $noWait);

$channel->basic_qos(null, 100, null);

// ------- FIRST QUEUE
$queueName = 'first_queue';
$passive = false;//server will reply with Declare-Ok if the queue already exists with the same name, and raise an error if not
$durable = true;//durable queue remain active when a server restarts.
$exclusive = false; // we don't want the queue to be accessed only by the current connection
$autoDelete = false; // we don't want the queue to be delete once all consumers have finished using it
$noWait = false; //we want to wait for the response of the server
$channel->queue_declare($queueName, $passive, $durable, $exclusive, $autoDelete, $noWait);

$routingKey = false;
$channel->queue_bind($queueName, 'direct_exchange',$routingKey ? 'orange': 'first_queue');

// ------- SECOND QUEUE
$channel->queue_declare('second_queue', false, true, false, false, false);
// routing key is optionnal
$channel->queue_bind('second_queue', 'direct_exchange', $routingKey ? 'black' : null);
$channel->queue_bind('second_queue', 'direct_exchange', $routingKey ? 'green': null);

$properties = array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT);
$body = json_encode(['accounts' => [['transactions' => [['id' => time()]]]]]);
$msg = new AMQPMessage($body, $properties);

$mandatory = false; //  If this flag is set, the server will return an unroutable message with a Return method.
// If this flag is zero, the server silently drops the message.
$immediate = true; // If this flag is set, the server will return an undeliverable message with a Return method.
// If this flag is zero, the server will queue the message, but with no guarantee that it will ever be consumed.

$channel->basic_publish($msg, 'direct_exchange', $routingKey  ? 'orange' : 'first_queue', $mandatory, $immediate);