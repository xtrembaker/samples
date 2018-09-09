<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__.'/../../vendor/autoload.php';
require_once './../../config.php';

$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS);
$channel = $connection->channel();
$channel->exchange_declare('topic_exchange', 'topic');
$channel->basic_qos(null, 100, null);

DEFINE('FIRST_QUEUE', 'first_queue');
DEFINE('SECOND_QUEUE', 'second_queue');
DEFINE('THIRD_QUEUE', 'third_queue');
DEFINE('FOURTH_QUEUE', 'fourth_queue');
DEFINE('FIFTH_QUEUE', 'fifth_queue');


$mappingQueueRoutingKey = [
    FIRST_QUEUE => 'matters.*',
    SECOND_QUEUE => '*.matters.tech',
    THIRD_QUEUE => '*.matters.*',
    FOURTH_QUEUE => 'support.matters.tech',
    FIFTH_QUEUE => '#.matters.tech'
];

// ------- FIRST QUEUE (matters.*)
$passive = false;//what's this ?
$durable = true;
$exclusive = false; // we don't want the queue to be accessed only by the current connection
$autoDelete = false; // we don't want the queue to be delete once the connection closes
$noWait = false; //what's this ?
$channel->queue_declare(FIRST_QUEUE, $passive, $durable, $exclusive, $autoDelete, $noWait);
$channel->queue_bind(FIRST_QUEUE, 'topic_exchange', $mappingQueueRoutingKey[FIRST_QUEUE]);

// ------- SECOND QUEUE (*.matters.tech)
$channel->queue_declare(SECOND_QUEUE, false, true, false, false, false);
$channel->queue_bind(SECOND_QUEUE, 'topic_exchange', $mappingQueueRoutingKey[SECOND_QUEUE]);

// ------- THIRD QUEUE (*.matters.*)
$channel->queue_declare(THIRD_QUEUE, false, true, false, false, false);
$channel->queue_bind(THIRD_QUEUE, 'topic_exchange', $mappingQueueRoutingKey[THIRD_QUEUE]);

// ------- FOURTH QUEUE (support.matters.tech)
$channel->queue_declare(FOURTH_QUEUE, false, true, false, false, false);
$channel->queue_bind(FOURTH_QUEUE, 'topic_exchange', $mappingQueueRoutingKey[FOURTH_QUEUE]);

// ------- FIFTH QUEUE (#.matters.tech)
$channel->queue_declare(FIFTH_QUEUE, false, true, false, false, false);
$channel->queue_bind(FIFTH_QUEUE, 'topic_exchange', $mappingQueueRoutingKey[FIFTH_QUEUE]);


$properties = array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT);
$body = json_encode(['accounts' => [['transactions' => [['id' => time()]]]]]);
$msg = new AMQPMessage($body, $properties);

$provider = [
    'matters.fr', //FIRST_QUEUE
    'squad.matters.tech', // SECOND_QUEUE, THIRD_QUEUE, FIFTH_QUEUE
    'spinning_top.squad.matters.tech', // FIFTH_QUEUE
    'support.matters.tech',//SECOND_QUEUE, THIRD_QUEUE, FOURTH_QUEUE, FIFTH_QUEUE
    'gitlab.support.matters.fr' // NO QUEUE
];

$channel->basic_publish($msg, 'topic_exchange', $provider[4]);


/**
 * http://whitfin.io/multiple-routing-keys-in-rabbitmq-exchanges/
 * les différents topics:
 * matters.* =>
 * *.matters.tech =>
 * *.matters.* =>
 * support.matters.tech
 * #.matters.tech
 *
 * Les jeux de test :
 * matters.fr => [matters.*]
 * squad.matters.tech => [*.matters.tech, #.matters.tech, *.matters.*]
 * spinning_top.squad.matters.tech => [#.matters.tech]
 * gitlab.support.matters.fr => ne sera pas routé
 */
