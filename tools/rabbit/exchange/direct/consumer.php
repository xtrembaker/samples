<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__.'/../../vendor/autoload.php';
require './../../config.php';

$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS);
$channel = $connection->channel();
$channel->exchange_declare('direct_exchange', 'direct', false, true, false, false, false);
// DECLARE QUEUE
$queueName = 'first_queue';
$channel->queue_declare($queueName, false, true, false, false);
// DECLARE CONSUMER
$noLocal = false;//what's this ?
$noAck = false;
$exclusive = false;// why is this option on consume ?
$noWait = false; //what's this ?

$callback = function (AMQPMessage $message)use($channel){
    echo "body: ".$message->getBody()."\n";

    sleep(3);
    $channel->basic_ack($message->delivery_info['delivery_tag']);
    echo "Done \n";
};

$channel->basic_consume($queueName, '', $noLocal, $noAck, $exclusive, $noWait, $callback);
while(count($channel->callbacks)) {
    $channel->wait();
}