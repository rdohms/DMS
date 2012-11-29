<?php

namespace DMS\Bundle\TwigExtensionBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('dms_twig_extension');

        $rootNode->children()
            ->arrayNode('fabpot')
                ->addDefaultsIfNotSet()
                ->children()
                    ->booleanNode('i18n')->defaultFalse()->end()
                    ->booleanNode('text')->defaultTrue()->end()
                    ->booleanNode('intl')->defaultTrue()->end()
                    ->booleanNode('debug')->defaultTrue()->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
