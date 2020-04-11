<?php declare(strict_types=1);

namespace Mutex\Atomic;

use Swoole\Table;

class Floating extends Atomic implements AtomicInterface
{
    public function __construct(float $initial = 0.0, int $size = 0)
    {
        parent::__construct(Table::TYPE_FLOAT, $size);
        $this->init($initial);
    }

    public function inc(float $by = 1): self
    {
        $this->mut($this->value() + $by);
        return $this;
    }

    public function value(): float
    {
        return floatval(parent::value());
    }

    public function dec(float $by = 1): self
    {
        $this->mut($this->value() - $by);
        return $this;
    }

    public function set(float $value): self
    {
        $this->mut($value);
        return $this;
    }
}
