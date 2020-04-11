<?php declare(strict_types=1);

namespace Mutex\Test\Atomic;

use Mutex\Atomic\Boolean;
use PHPUnit\Framework\TestCase;

class BooleanTest extends TestCase
{
    public function testToggle()
    {
        $bool = new Boolean();
        go(fn() => $this->assertFalse($bool->value()));
        go(fn() => $bool->toggle());
        go(fn() => $this->asserttrue($bool->value()));
    }
}
