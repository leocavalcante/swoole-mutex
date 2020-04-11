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
        $this->table->set($pattern, [self::TUPLE_VALUE => $value]);
        return $this;
    }

    public function take(string $pattern)
    {
        return $this->table[$pattern][self::TUPLE_VALUE];
    }
}
