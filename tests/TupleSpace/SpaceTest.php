<?php declare(strict_types=1);

namespace Mutex\Test\TupleSpace;

use Mutex\TupleSpace\Space;
use PHPUnit\Framework\TestCase;
use stdClass;

class SpaceTest extends TestCase
{
    public function testPutAndTake()
    {
        $space = new Space();

        go(fn() => $space->put('foo', 'bar'));
        go(fn() => $this->assertSame('bar', $space->take('foo')));

        go(fn() => $space->put('bar', 42));
        go(fn() => $this->assertSame(42, $space->takeInt('bar')));

        $fixture = new stdClass();
        $fixture->foo = 'bar';

        go(fn() => $space->put('obj', $fixture));
        go(fn() => $this->assertSame('bar', $space->take('obj')->foo));
    }
}
