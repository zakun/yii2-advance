<?php


namespace common\tests\unit;

use common\models\User;
use PHPUnit\Framework\TestCase;
class StubTest extends TestCase
{
    public function testStub()
    {
        $stub = $this->createMock(User::class);

        // 配置桩件。
        $stub->method('doSomething')
            ->willReturn('foo');

        // 现在调用 $stub->doSomething() 将返回 'foo'。
        $this->assertEquals('foo', $stub->doSomething());
    }
}