<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__.'/../../vendor/autoload.php';
require './../../config.php';

$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS);
$channel = $connection->channel();

$queueName = 'first_queue';
$passive = false;//what's this ?
$durable = true;
$exclusive = false; // we don't want the queue to be accessed only by the current connection
$autoDelete = false; // we don't want the queue to be delete once the connection closes
$noWait = false; //what's this ?
$channel->queue_declare($queueName, $passive, $durable, $exclusive, $autoDelete, $noWait);
$channel->basic_qos(null, 1, null);
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