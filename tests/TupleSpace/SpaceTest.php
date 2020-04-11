<?php declare(strict_types=1);

namespace Mutex\Test\TupleSpace;

use Mutex\TupleSpace\Space;
use PHPUnit\Framework\TestCase;

class SpaceTest extends TestCase
{
    public function testPutAndTake()
    {
        $space = new Space();
        go(fn() => $space->put('foo', 'bar'));
        go(fn() => $this->assertSame('bar', $space->take('foo')));
    }
}
