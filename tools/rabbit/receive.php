<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Wire\AMQPTable;

/**
 * To use : php receive.php
 *
 * For test purpose only : If message contain "Coucou4" and the message
 * was created less than 15 seconds, we requeue the message
 */
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$start = new \DateTime();

// Declare queue in case it's not already declared
$channel->queue_declare('hello', false, false, false, false, false, new AMQPTable(array(
    "x-dead-letter-exchange" => "delayed"
)));

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function($msg)use($channel, $start) {
  $now = new \DateTime();
  echo "diff : ".$start->diff($now)->format('%s')."\n";
//    $headers = $msg->get('application_headers');
//    $nativeData = $headers->getNativeData();
//    var_dump($nativeData['x-delay']);
    //var_dump($msg);
  if($msg->body === 'Coucou4' && $start->diff($now)->format('%s') < 15){
    echo "NACK\n";
	$channel->basic_nack($msg->delivery_info['delivery_tag'], false, true);
  }else{
    echo " [x] Received ", $msg->body, "\n";
    $channel->basic_ack($msg->delivery_info['delivery_tag']);
  }
};

$channel->basic_consume('hello', '', false, false, false, false, $callback);
while(count($channel->callbacks)) {
    $channel->wait();
}
