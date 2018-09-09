<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__.'/../vendor/autoload.php';
require './../config.php';

$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS);
$channel = $connection->channel();

$queueName = 'notification';
$channel->queue_declare($queueName, false, true, false, false, false);

$channel->basic_qos(null, 100, null);

$callback = function (AMQPMessage $message)use($channel){
    echo "message: ".$message->getBody()."\n";

    sleep(5);
    // simulate service not available
    if(rand(0,9) % 2 === 0){
        echo "Service not available, send message to delayed queue\n";
        $channel->basic_ack($message->delivery_info['delivery_tag']);
        $channel->basic_publish($message,'','delayed_notification');
        return;
    }
    $channel->basic_ack($message->delivery_info['delivery_tag']);
    echo "Sent \n";
};

$noLocal = false;//	If true, the server will not send messages to the connection that published them.
$noAck = false; //If true, the server does not expect acknowledgements for messages.
// That is, when a message is delivered to the client the server assumes the delivery will succeed and immediately dequeues it.
// This functionality may increase performance but at the cost of reliability.
$exclusive = false;// if true, only this consumer can access to the queue
$noWait = false; //what's this ?
$channel->basic_consume($queueName, '', $noLocal, $noAck, $exclusive, $noWait, $callback);
while(count($channel->callbacks)) {
    $channel->wait();
}