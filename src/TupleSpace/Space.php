<?php declare(strict_types=1);

namespace Mutex\TupleSpace;

use Swoole\Table;

class Space
{
    private const TUPLE_VALUE = 'value';
    private Table $table;

    public function __construct()
    {
        $this->table = new Table(1024);
        $this->table->column(self::TUPLE_VALUE, Table::TYPE_STRING, 64);
        $this->table->create();
    }

    public function put(string $pattern, $value): self
    {
        $this->table->set($pattern, [self::TUPLE_VALUE => serialize($value)]);
        return $this;
    }

    public function take(string $pattern, ?string $className = null)
    {
        return unserialize($this->table[$pattern][self::TUPLE_VALUE]);
    }

    public function takeInt(string $pattern): int
    {
        return intval($this->take($pattern));
    }
}
