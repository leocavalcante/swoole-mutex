<?php declare(strict_types=1);

namespace Mutex\Atomic;

use Swoole\Table;

class Integer extends Atomic implements AtomicInterface
{
    public function __construct(int $initial = 0, int $size = 0)
    {
        parent::__construct(Table::TYPE_INT, $size);
        $this->init($initial);
    }

    public function value(): int
    {
        return intval(parent::value());
    }

    public function inc(int $by = 1): self
    {
        $this->mut($this->value() + $by);
        return $this;
    }

    public function dec(int $by = 1): self
    {
        $this->mut($this->value() - $by);
        return $this;
    }
}
