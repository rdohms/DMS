<?php

namespace DMS\Filter\Rules;

use Tests;

class AlnumTest extends Tests\Testcase
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
        $rule = new Alnum($options);

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
            array(false, "My Text", "MyText", true),
            array(false, "My Text", "MyText", false),
            array(true, "My Text", "My Text", true),
            array(true, "My Text", "My Text", false),
            array(true, "My Text!", "My Text", true),
            array(true, "My Text!", "My Text", false),
            array(true, "My Text21!", "My Text21", true),
            array(true, "My Text21!", "My Text21", false),
            array(true, "João Sorrisão", "João Sorrisão", true),
            array(true, "João Sorrisão", "Joo Sorriso", false),
            array(true, "Helgi Þormar Þorbjörnsson", "Helgi Þormar Þorbjörnsson", true),
            array(true, "Helgi Þormar Þorbjörnsson", "Helgi ormar orbjrnsson", false),
            array(true, "Helgi Þormar!@#$&*( )(*&%$#@Þorbjörnsson", "Helgi Þormar Þorbjörnsson", true),
            array(true, "Helgi Þormar!@#$&*( )(*&%$#@Þorbjörnsson", "Helgi ormar orbjrnsson", false),
        );
    }
}