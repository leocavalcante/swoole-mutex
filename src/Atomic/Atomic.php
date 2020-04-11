<?php declare(strict_types=1);

namespace Mutex\Atomic;

use Swoole\Table;

class Atomic
{
    private const VALUE_KEY = 'value';
    private const INITIAL_KEY = '0';
    private Table $table;

    protected function __construct(int $type, int $size)
    {
        $this->table = new Table(1024);
        $this->table->column(self::VALUE_KEY, $type, $size);
        $this->table->create();
    }

    protected function init($initial)
    {
        $this->table->set(self::INITIAL_KEY, [self::VALUE_KEY => $initial]);
    }

    protected function mut($newValue): self
    {
        $this->table->set($this->next(), [self::VALUE_KEY => $newValue]);
        return $this;
    }

    protected function next(): string
    {
        return strval($this->table->count());
    }

    protected function value()
    {
        return $this->table->get($this->last())[self::VALUE_KEY];
    }

    protected function last(): string
    {
        return strval($this->table->count() - 1);
    }
}
