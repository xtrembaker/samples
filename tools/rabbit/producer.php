<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__.'/vendor/autoload.php';
require_once './config.php';

$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS);
$channel = $connection->channel();
$queueName = 'budgea_webhook';
$passive = false;//what's this ?
$durable = true;
$exclusive = false; // we don't want the queue to be accessed only by the current connection
$autoDelete = false; // we don't want the queue to be delete once the connection closes
$noWait = false; //what's this ?
$channel->queue_declare($queueName, $passive, $durable, $exclusive, $autoDelete, $noWait);

// declare delay_queue
$channel->queue_declare('delay_queue',false,true,false,false,false
    ,array('x-message-ttl'=>array('I',30000)
    , 'x-dead-letter-exchange'=>array('S','')
    , 'x-dead-letter-routing-key'=>array('S',$queueName)
    )
);

$properties = array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT);
$body = json_encode(['accounts' => [['transactions' => [['value' => time()]]]]]);
$msg = new AMQPMessage($body, $properties);
$channel->basic_publish($msg, '', $queueName);
