<?php

namespace Symfony\Component\Form\Tests\Extension\Validator\Type;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use DMS\Bundles\FilterBundle\Tests\Dummy\AnnotatedClass;
use DMS\Bundles\FilterBundle\Form\FilterExtension;
use Symfony\Component\Form\Tests\Extension\Core\Type\TypeTestCase;

class FormTypeFilterExtensionTest extends TypeTestCase
{
    /**
     * @var \DMS\Bundles\FilterBundle\Service\Filter
     */
    protected $filter;

    /**
     * @var boolean
     */
    protected $autoFilter = true;

    protected function setUp()
    {
        $this->filter = $this->getMock('DMS\Bundles\FilterBundle\Service\Filter');

        parent::setUp();
    }

    protected function tearDown()
    {
        $this->filter = null;
        $this->autoFilter = true;

        parent::tearDown();
    }

    protected function getExtensions()
    {
        return array_merge(parent::getExtensions(), array(
            new FilterExtension($this->filter, $this->autoFilter),
        ));
    }

    public function testFilterSubscriberDefined()
    {
        /** @var $form \Symfony\Component\Form\Form */
        $form =  $this->factory->create('form');

        $dispatcher = $this->readAttribute($form, 'dispatcher');

        $listeners = $dispatcher->getListeners(FormEvents::POST_BIND);

        $filter = function($value){

            return (get_class($value[0]) == "DMS\Bundles\FilterBundle\Form\EventListener\DelegatingFilterListener");
        };

        $filterListeners = array_filter($listeners, $filter);

        $this->assertEquals(1, count($filterListeners));
    }

    public function testFilterSubscriberDisabled()
    {
        $this->autoFilter = false;
        $this->setUp();

        /** @var $form \Symfony\Component\Form\Form */
        $form =  $this->factory->create('form');

        $dispatcher = $this->readAttribute($form, 'dispatcher');

        $listeners = $dispatcher->getListeners(FormEvents::POST_BIND);
    }

    public function testBindValidatesData()
    {
        $entity = new AnnotatedClass();
        $builder = $this->factory->createBuilder('form', $entity);
        $builder->add('name', 'form');
        $form = $builder->getForm();

        $this->filter->expects($this->atLeastOnce())
            ->method('filterEntity');

        // specific data is irrelevant
        $form->bind(array());
    }
}
