# Exchange 

### exchange type
- direct
    - routingkey (optionnal)
- topic
- fanout
- headers

# PostPone message (using deadLetter)

# Rpc

# Transactions


Note :

On MacOS RabbitMQ was installed using a Docker : https://hub.docker.com/_/rabbitmq/

https://coderwall.com/p/uqp34w/install-rabbitmq-via-docker-in-os-x

image repository: docker run -d --hostname my-rabbit --name some-rabbit rabbitmq:3-management

nack vs reject : https://github.com/LeanKit-Labs/wascally/issues/84

Delayed messages : https://www.rabbitmq.com/blog/2015/04/16/scheduling-messages-with-rabbitmq/


Start daemon on MacOSX :
docker run -d -p 5672:5672 -p 15672:15672 --hostname my-rabbit --name some-rabbit rabbitmq:3-management


Exchange :
php exchange/emit_logs.php 
php exchange/receive_logs.php


https://gagnechris.wordpress.com/2015/09/19/easy-retries-with-rabbitmq/

En mode "direct" on peut utiliser le routing key

A FAIRE:
- bouger le qos

Trouver des réponses:
- Qu'est-ce qu'un channel ?
- Qu'est -ce que le state d'une queue "ready / idle" ?


# RabbitMQ API
- basic_nack: manually unack a message
- basic_reject: Was introduced before basic_nack, but is less powerful
- batch_basic_publish: Prepare messages as a batch
- publish_batch:  Once you've send your batch using "batch_basic_publish", use that function to publish all of them
- tx_select: start transaction
- tx_commit: commit transaction (after publish_batch)
- tx_rollback: rollback transaction