<?php

declare(strict_types=1);

namespace PTS\SyliusPayseraPlugin\DependencyInjection;

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
        $config = $this->processConfiguration($this->getConfiguration([], $container), $config);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $container->setParameter('gateway_factory_class',
            PayseraGatewayFactory::class
        );

        $loader->load('services.xml');
    }
}
