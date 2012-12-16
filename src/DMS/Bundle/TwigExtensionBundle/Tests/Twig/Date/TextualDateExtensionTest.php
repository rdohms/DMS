<?php

namespace DMS\Bundle\TwigExtensionBundle\Tests\Twig\Date;

use DMS\Bundle\TwigExtensionBundle\Twig\Date\TextualDateExtension;

class DateExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TextualDateExtension
     */
    protected $extension;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $translator;

    public function setUp()
    {
        $this->buildDependencies();
        $this->extension = new TextualDateExtension($this->translator);
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider provideForException
     */
    public function testTextualDateFilterInputValidation($date)
    {
        $result = $this->extension->textualDateFilter($date);
    }

    public function provideForException()
    {
        return array(
            array(date('ymd')),
            array('02/02/2012'),
            array(time()),
        );
    }

    /**
     * @param $dateDescription
     * @param $expectedOutput
     * @return void
     *
     * @dataProvider provideForTextual
     */
    public function testTextualDateFilter($dateDescription, $expectedOutput)
    {
        $date = new \DateTime($dateDescription);

        $this->translator->expects($this->once())
            ->method('transChoice')
            ->will($this->returnCallback(function() { return func_get_args(); }));

        $result = $this->extension->textualDateFilter($date);

        $this->assertEquals($expectedOutput, $result[0]);

    }

    public function provideForTextual()
    {
        return array(
            array('-16 seconds', 'ago.s'),
            array('-1 minute',   'ago.i'),
            array('-5 minutes',  'ago.i'),
            array('-1 hour',     'ago.h'),
            array('-5 hour',     'ago.h'),
            array('-30 hour',    'date.yesterday'),
            array('-31 hour',    'date.yesterday'),
            array('+31 hour',    'date.tomorrow'),
            array('-1 day',      'date.yesterday'),
            array('+1 day',      'date.tomorrow'),
            array('-2 day',      'ago.d'),
            array('-3 day',      'ago.d'),
            array('-31 day',     'ago.m'),
            array('-367 day',    'ago.y'),
            array('+367 day',    'next.y'),
            array('+40 days',    'next.m'),
            array('+48 hours',   'next.d'),
            array('+5 hour',     'next.h'),
            array('+5 minutes',  'next.i'),
            array('+25 seconds',  'next.s'),
            array('now',         'date.just_now'),
        );
    }

    protected function buildDependencies()
    {
        $this->translator = $this->getMockBuilder('Symfony\Bundle\FrameworkBundle\Translation\Translator')
            ->disableOriginalConstructor()->getMock();
    }
}
