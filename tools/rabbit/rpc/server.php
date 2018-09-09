<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__.'/../vendor/autoload.php';
require_once './../config.php';

$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS);
$channel = $connection->channel();

$channel->queue_declare('rpc_queue', false, false, false, false);

function fib($n)
{
    if ($n == 0) {
        return 0;
    }
    if ($n == 1) {
        return 1;
    }
    return fib($n-1) + fib($n-2);
}

echo " [x] Awaiting RPC requests\n";
$callback = function (AMQPMessage $req) {
    $n = intval($req->body);
    echo ' [.] fib(', $n, ")\n";

    $properties = array(
        'content_type' => 'shortstr',
        'content_encoding' => 'shortstr',
        'application_headers' => 'table_object',
        'delivery_mode' => 'octet',
        'priority' => 'octet',
        'correlation_id' => 'shortstr',
        'reply_to' => 'shortstr',
        'expiration' => 'shortstr',
        'message_id' => 'shortstr',
        'timestamp' => 'timestamp',
        'type' => 'shortstr',
        'user_id' => 'shortstr',
        'app_id' => 'shortstr',
        'cluster_id' => 'shortstr',
    );

    foreach($properties as $key => $property){
        echo "property : $key :";
        try{
            var_dump($req->get($key));
            echo "\n";
        }catch (\Exception $e){
            echo "\n";
        }
    }

    //var_dump($req->get('toto'));

    $msg = new AMQPMessage(
        (string) fib($n),
        array('correlation_id' => $req->get('correlation_id'))
    );

    $req->delivery_info['channel']->basic_publish(
        $msg,
        '',
        $req->get('reply_to')
    );
    $req->delivery_info['channel']->basic_ack(
        $req->delivery_info['delivery_tag']
    );
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('rpc_queue', '', false, false, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();