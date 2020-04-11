<?php declare(strict_types=1);

namespace Mutex\Test\Atomic;

use Mutex\Atomic\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function testConcat()
    {
        $str = new Str('Hello, ');
        go(fn() => $this->assertSame('Hello, ', $str->value()));
        $str->concat('World!');
        go(fn() => $this->assertSame('Hello, World!', $str->value()));
    }

    public function testSet()
    {
        $str = new Str('Hello, ');
        go(fn() => $this->assertSame('Hello, ', $str->value()));
        $str->set('World!');
        go(fn() => $this->assertSame('World!', $str->value()));
    }
}
