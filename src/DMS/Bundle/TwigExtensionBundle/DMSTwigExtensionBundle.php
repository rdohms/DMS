<?php

namespace DMS\Bundle\TwigExtensionBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use DMS\Bundle\TwigExtensionBundle\DependencyInjection\TwigExtensionCompilerPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;

class DMSTwigExtensionBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }
}
