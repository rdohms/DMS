<?php

namespace DMS\Bundle\LauncherBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('dms_launcher');

        $rootNode->children()->scalarNode('stylesheet')->defaultValue('/bundles/dmslauncher/css/launcher.css')->end();
        $rootNode->children()->scalarNode('site_url')->cannotBeEmpty()->isRequired()->end();
        $rootNode->children()->scalarNode('twitter_account')->defaultNull()->end();
        $rootNode->children()->scalarNode('enable')->defaultTrue()->end();

        return $treeBuilder;
    }
}
