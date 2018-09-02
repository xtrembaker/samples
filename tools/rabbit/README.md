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



A FAIRE:
- bouger le qos