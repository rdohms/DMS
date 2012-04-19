<?php

namespace Tests;

use DMS\Filter\Mapping,
    Doctrine\Common\Annotations;

class Testcase extends \PHPUnit_Framework_TestCase
{
    protected $loader;

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    protected function buildMetadataFactory()
    {
        $reader = new Annotations\AnnotationReader();

        $loader = new Mapping\Loader\AnnotationLoader($reader);
        $this->loader = $loader;

        $metadataFactory = new Mapping\ClassMetadataFactory($loader);

        return $metadataFactory;
    }
}