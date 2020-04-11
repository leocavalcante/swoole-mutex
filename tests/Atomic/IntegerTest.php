<?php declare(strict_types=1);

namespace Mutex\Test\Atomic;

use Mutex\Atomic\Integer;
use PHPUnit\Framework\TestCase;

class IntegerTest extends TestCase
{
    public function testInc()
    {
        $int = new Integer(0);
        go(fn() => $this->assertSame(0, $int->value()));
        $int->inc();
        go(fn() => $this->assertSame(1, $int->value()));
        $int->inc(2);
        go(fn() => $this->assertSame(3, $int->value()));
    }

    public function testDec()
    {
        $int = new Integer(3);
        go(fn() => $this->assertSame(3, $int->value()));
        $int->dec();
        go(fn() => $this->assertSame(2, $int->value()));
        $int->dec(2);
        go(fn() => $this->assertSame(0, $int->value()));
    }

    public function testSet()
    {
        $int = new Integer(0);
        go(fn() => $this->assertSame(0, $int->value()));
        $int->set(42);
        go(fn() => $this->assertSame(42, $int->value()));
    }
}
