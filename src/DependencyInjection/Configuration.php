<?php

declare(strict_types=1);

namespace PTS\SyliusPayseraPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('pts_sylius_paysera_plugin');
        if (\method_exists($treeBuilder, 'getRootNode')) {
            $treeBuilder->getRootNode();
        } else {
            $treeBuilder->root('pts_sylius_paysera_plugin');
        }

        return $treeBuilder;
    }
}
