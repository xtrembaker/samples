<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__.'/../vendor/autoload.php';
require_once './../config.php';

$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS);
$channel = $connection->channel();
$queueName = 'notification';
$channel->queue_declare($queueName, false, true, false, false, false);

// declare delay_queue
$channel->queue_declare('delayed_notification',false,true,false,false,false
    ,array('x-message-ttl'=>array('I',10000)
    , 'x-dead-letter-exchange'=>array('S','')
    , 'x-dead-letter-routing-key'=>array('S',$queueName)
    )
);
$channel->exchange_declare('direct', 'direct');
$channel->queue_bind($queueName, 'direct');

$properties = array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT);
$body = 'Vous êtes le '.time().'ème visiteurs !';
$msg = new AMQPMessage($body, $properties);
$channel->basic_publish($msg, '', $queueName);
