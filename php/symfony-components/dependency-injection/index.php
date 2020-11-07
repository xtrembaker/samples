<?php

use App\AlertRepository;
use App\IRepository;
use App\Service;
use App\Repository;
use Symfony\Component\DependencyInjection\Compiler\AutowirePass;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\Configurator\ServiceConfigurator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

require __DIR__.'/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$containerBuilder->autowire(AlertRepository::class, AlertRepository::class);
$containerBuilder->autowire('toto',Repository::class);
$containerBuilder->autowire(Service::class, Service::class)
    ->addArgument(new Reference('toto'));

$autowirePass = new AutowirePass(true);
$autowirePass->process($containerBuilder);


/** @var Service $service */
$service = $containerBuilder->get(Service::class);
echo $service->process();
exit();