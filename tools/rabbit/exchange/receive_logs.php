<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('logs', 'x-delayed-message', false, false, false, false, false, new \PhpAmqpLib\Wire\AMQPTable([
    "x-delayed-type" => "direct"
]));

list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

$channel->queue_bind($queue_name, 'logs');

echo ' [*] Waiting for logs. To exit press CTRL+C', "\n";
$start = new \DateTime();

$callback = function($msg)use($start, $channel){
    $now = new \DateTime();
    echo "diff : ".$start->diff($now)->format('%s')."\n";
    echo ' [x] ', $msg->body, "\n";
    if($msg->body === 'Coucou4' && $start->diff($now)->format('%s') < 10){
        echo "NACK\n";
        $channel->basic_nack($msg->delivery_info['delivery_tag'], false, true);
    }
};

$channel->basic_consume($queue_name, '', false, false, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();

?>