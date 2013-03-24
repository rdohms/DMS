<?php

namespace DMS\Bundle\MeetupApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dms_meetup_api');

        $rootNode->children()
            ->arrayNode('client')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('key')->defaultNull()->end()
                    ->scalarNode('consumer_key')->defaultNull()->end()
                    ->scalarNode('consumer_secret')->defaultNull()->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
