<?php


namespace common\tests\unit;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Error;
use yii\base\InvalidArgumentException;

class ExceptionTest extends TestCase
{
    public function testException()
    {
        $this->expectException(InvalidArgumentException::class);
        throw new InvalidArgumentException();
    }

    /**
     * @expectedException /yii/base/InvalidArgumentException
     */
    public function testException2()
    {
        throw new InvalidArgumentException();
    }

    /**
     * @expectedException Error
     */
    public function testFailingInclude()
    {
        include 'not_existing_file.php';
    }
}