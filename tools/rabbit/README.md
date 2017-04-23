Note :

On MacOS RabbitMQ was installed using a Docker : https://hub.docker.com/_/rabbitmq/

nack vs reject : https://github.com/LeanKit-Labs/wascally/issues/84

Delayed messages : https://www.rabbitmq.com/blog/2015/04/16/scheduling-messages-with-rabbitmq/


Start daemon on MacOSX :
docker run -d -p5672:5672 --hostname my-rabbit --name some-rabbit rabbitmq:3
