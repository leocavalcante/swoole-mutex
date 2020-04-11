<?php declare(strict_types=1);

namespace Mutex\Atomic;

use Swoole\Table;

class Str extends Atomic implements AtomicInterface
{
    public function __construct(string $initial = '', int $size = 64)
    {
        parent::__construct(Table::TYPE_STRING, $size);
        $this->init($initial);
    }

    public function concat(string $val): self
    {
        $this->mut($this->value() . $val);
        return $this;
    }

    public function value(): string
    {
        return strval(parent::value());
    }

    public function set(string $val): self
    {
        $this->mut($val);
        return $this;
    }
}
