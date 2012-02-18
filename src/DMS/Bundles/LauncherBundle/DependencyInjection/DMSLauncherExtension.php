<?php

namespace DMS\Bundles\LauncherBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class DMSLauncherExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        //$twigEnv = $container->get('twig');

        //Set Config values as Parameters for access in templates
        $container->setParameter('dms_launcher.site_url', $config['site_url']);
        $container->setParameter('dms_launcher.twitter_account', $config['twitter_account']);
        $container->setParameter('dms_launcher.stylesheet', $config['stylesheet']);

        foreach($config as $key => $value)
        {
            $parameterName = 'dms_launcher.'.$key;

            $container->setParameter($parameterName, $value);
            //$twigEnv->addGlobal($parameterName, $value);
        }

    }
    
    public function getAlias()
    {
        return 'dms_launcher';
    }

}
