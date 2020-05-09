<?php


namespace common\tests\unit;

use PHPUnit\Framework\TestCase;
class DependencyAndDataProviderComboTest extends TestCase
{
    public function provider()
    {
        return [['provider1'], ['provider2']];
    }

    public function testProducerFirst()
    {
        $this->assertTrue(true);
        return 'first';
    }

    public function testProducerSecond()
    {
        $this->assertTrue(true);
        return 'second';
    }

    /**
     * @depends testProducerFirst
     * @depends testProducerSecond
     * @dataProvider provider
     */
    public function testConsumer()
    {

        list($provider, $first, $second) = func_get_args();
        $this->assertRegExp('/provider(\d)/', $provider);
        $this->assertEquals('first', $first);
        $this->assertEquals('second', $second);
    }
}