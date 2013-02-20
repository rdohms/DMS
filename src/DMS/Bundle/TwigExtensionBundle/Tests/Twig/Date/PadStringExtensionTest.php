<?php

namespace DMS\Bundle\TwigExtensionBundle\Tests\Twig\Text;

use DMS\Bundle\TwigExtensionBundle\Twig\Text\PadStringExtension;

class PadStringExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PadStringExtension
     */
    protected $extension;

    public function setUp()
    {
        $this->extension = new PadStringExtension();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider provideForException
     */
    public function testPadStringFilterInputValidation($value, $padCharacter, $maxLength, $padType = 'STR_PAD_RIGHT')
    {
        $result = $this->extension->padStringFilter($value, $padCharacter, $maxLength, $padType);
    }

    public function provideForException()
    {
        return array(
            array('ps', 'o', '4', 'STR_PAD_LEFT'),
            array('woof', null, 6, 'STR_PAD_BOTH'),
            array('squ', '', 2, 'STR_PAD_RIGHT'),
            array('NO', '', '5'),
        );
    }

    /**
     * @param $value
     * @param $padCharacter
     * @param $maxLength
     * @param string $padType
     * @param $expectedOutput
     *
     * @dataProvider provideForPadTest
     */
    public function testPadStringFilterOutput($expectedOutput, $value, $padCharacter, $maxLength, $padType = 'STR_PAD_RIGHT')
    {
        $result = $this->extension->padStringFilter($value, $padCharacter, $maxLength, $padType);
        $this->assertEquals($expectedOutput, $result);
    }

    public function provideForPadTest()
    {
        return array(
            array('oops', 'ps', 'o', 4, 'STR_PAD_LEFT'),
            array('-woof-', 'woof', '-', 6, 'STR_PAD_BOTH'),
            array('squeeeee', 'squ', 'e', 8, 'STR_PAD_RIGHT'),
            array('NOOOO', 'NO', 'O', 5),
            array('hahahahaha', '', 'ha', 10),
        );
    }
}
