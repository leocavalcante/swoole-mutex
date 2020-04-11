<?php declare(strict_types=1);

namespace Mutex\Atomic;

use Swoole\Table;

class Boolean extends Atomic implements AtomicInterface
{
    public function __construct(bool $initial = false)
    {
        parent::__construct(Table::TYPE_INT, 1);
        $this->init($initial ? 1 : 0);
    }

    public function toggle(): self
    {
        $this->mut(!$this->value());
        return $this;
    }

    public function value(): bool
    {
        return boolval(parent::value());
    }
}
