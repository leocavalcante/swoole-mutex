<?php declare(strict_types=1);

namespace Mutex\Test\Atomic;

use Mutex\Atomic\Floating;
use PHPUnit\Framework\TestCase;

class FloatingTest extends TestCase
{
    public function testInc()
    {
        $int = new Floating(0.0);
        go(fn() => $this->assertSame(0.0, $int->value()));
        $int->inc();
        go(fn() => $this->assertSame(1.0, $int->value()));
        $int->inc(0.2);
        go(fn() => $this->assertSame(1.2, $int->value()));
    }

    public function testDec()
    {
        $int = new Floating(3.0);
        go(fn() => $this->assertSame(3.0, $int->value()));
        $int->dec();
        go(fn() => $this->assertSame(2.0, $int->value()));
        $int->dec(0.2);
        go(fn() => $this->assertSame(1.8, $int->value()));
    }

    public function testSet()
    {
        $int = new Floating(0.0);
        go(fn() => $this->assertSame(0.0, $int->value()));
        $int->set(4.2);
        go(fn() => $this->assertSame(4.2, $int->value()));
    }
}
