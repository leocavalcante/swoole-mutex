<?php declare(strict_types=1);

namespace Mutex\Atomic;

use Swoole\Table;

class Integer
{
    private const VALUE_KEY = 'value';
    private const INITIAL_KEY = '0';
    private Table $table;

    public function __construct(int $initial = 0)
    {
        $this->table = new Table(1024);
        $this->table->column(self::VALUE_KEY, Table::TYPE_INT);
        $this->table->create();
        $this->table->set(self::INITIAL_KEY, [self::VALUE_KEY => $initial]);
    }

    public function inc(int $by = 1): self
    {
        $this->table->set($this->next(), [self::VALUE_KEY => $this->value() + $by]);
        return $this;
    }

    private function next(): string
    {
        return strval($this->table->count());
    }

    public function value(): int
    {
        return $this->table->get($this->last())[self::VALUE_KEY];
    }

    private function last(): string
    {
        return strval($this->table->count() - 1);
    }

    public function dec(int $by = 1): self
    {
        $this->table->set($this->next(), [self::VALUE_KEY => $this->value() - $by]);
        return $this;
    }
}
