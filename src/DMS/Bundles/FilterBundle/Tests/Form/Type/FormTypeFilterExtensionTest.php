<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Form\Tests\Extension\Validator\Type;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Tests\Dummy\Classes\AnnotatedClass;
use Symfony\Component\Form\Tests\Extension\Core\Type\TypeTestCase;

class FormTypeFilterExtensionTest extends TypeTestCase
{
    /**
     * @var \DMS\Bundles\FilterBundle\Service\Filter
     */
    protected $filter;

    protected function setUp()
    {
        $this->filter = $this->getMock('DMS\Bundles\FilterBundle\Service\Filter');

        parent::setUp();
    }

    protected function tearDown()
    {
        $this->filter = null;

        parent::tearDown();
    }

    protected function getExtensions()
    {
        return array_merge(parent::getExtensions(), array(
            new \DMS\Bundles\FilterBundle\Form\Type\FormTypeFilterExtension($this->filter, true),
        ));
    }

    public function testFilterSubscriberDefined()
    {
        /** @var $form \Symfony\Component\Form\Form */
        $form =  $this->factory->create('form');

        $dispatcher = $this->readAttribute($form, 'dispatcher');

        $listeners = $dispatcher->getListeners(FormEvents::POST_BIND);

        var_dump($listeners);
    }

    public function testFilterSubscriberDisabled()
    {
        /** @var $form \Symfony\Component\Form\Form */
        $form =  $this->factory->create('form');

        $dispatcher = $this->readAttribute($form, 'dispatcher');

        $listeners = $dispatcher->getListeners(FormEvents::POST_BIND);

        var_dump($listeners);
    }

    public function testBindValidatesData()
    {
        $entity = new AnnotatedClass();
        $builder = $this->factory->createBuilder('form', $entity);
        $builder->add('name', 'form');
        $form = $builder->getForm();

        $this->filter->expects($this->once())
            ->method('filterEntity');

        // specific data is irrelevant
        $form->bind(array());
    }
}
