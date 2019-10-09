<?php

declare(strict_types=1);

namespace PTS\SyliusPayseraPlugin\DependencyInjection;

use PTS\Paysera\Api;
use PTS\Paysera\MockedApi;
use PTS\Paysera\MockedPayseraGatewayFactory;
use PTS\Paysera\PayseraGatewayFactory;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class PTSSyliusPayseraExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container): void
    {
        $this->processConfiguration($this->getConfiguration([], $container), $config);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $env = $container->getParameter("kernel.environment");

        $container->setParameter('gateway_factory_class',
            $env === 'test' ?
                MockedPayseraGatewayFactory::class : PayseraGatewayFactory::class
        );
        $container->setParameter('gateway_api_class_mocked',
            $env === 'test' ?
                true : false
        );

        $loader->load('services.xml');
    }
}
