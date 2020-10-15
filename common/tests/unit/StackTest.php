<?php


namespace common\tests\unit;

use PHPUnit\ExampleExtension\TestCaseTrait;
use PHPUnit\Framework\TestCase;
class StackTest extends TestCase
{
    use TestCaseTrait;
    /**
     * @covers
     */
    public function testPushAndPop()
    {
        $stack = [];
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertEquals(1, count($stack));

        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    }
}