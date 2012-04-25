<?php

namespace DMS\Filter\Rules;

use Tests;

class DigitsTest extends Tests\Testcase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @dataProvider provideForRule
     */
    public function testRule($options, $value, $expectedResult, $unicodeSetting = null)
    {
        $rule = new Digits($options);

        if ($unicodeSetting !== null) {

            $property = new \ReflectionProperty($rule, 'unicodeEnabled');
            $property->setAccessible(true);
            $property->setValue($rule, $unicodeSetting);

        }

        $result = $rule->applyFilter($value);

        $this->assertEquals($expectedResult, $result);
    }

    public function provideForRule()
    {
        return array(
            array(false, "My Text", ""),
            array(false, "001 t55", "00155"),
            array(true, "My 23 dogs", " 23 "),
            array(false, "My 23 dogs", "23"),
            array(true, "233 055", "233 055", true),
            array(true, "233 055", "233 055", false),
            array(true, "233 t055s", "233 055"),
            array(true, "My Text21!", "21"),
            array(true, "João Sorrisão", " ", true),
            array(true, "João Sorrisão", " ", false),
            array(true, "001Helgi Þormar Þorbjörnsson", "001  ", true),
            array(true, "001Helgi Þormar Þorbjörnsson", "001  ", false),
        );
    }
}