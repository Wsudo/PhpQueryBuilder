<?php

namespace Wsudo\PhpQueryBuilder\Builders;

use Amp\Future;
use Amp\Internal\FutureState;
use Wsudo\PhpQueryBuilder\Builders\Statments\Having;
use Wsudo\PhpQueryBuilder\Builders\Statments\OrderBy;
use Wsudo\PhpQueryBuilder\Builders\Statments\Where;
use Wsudo\PhpQueryBuilder\Interfaces\QueryBuilderInterface;
use Wsudo\PhpQueryBuilder\ReadyQuery;
use Wsudo\PhpQueryBuilder\Types\DatabaseType;

class Query implements QueryBuilderInterface
{
    use Where;
    use Having;
    use OrderBy;
    public $database;
    public $table;
    public $wheres;
    public $havings;
    public $joins;

    public function database(string $databaseName): self
    {
        return $this;
    }
    public function table(string $tableName): self
    {
        return $this;
    }
    public function select(string|array $columns): self
    {
        return $this;
    }
    public function count(): self
    {
        return $this;
    }
    public function from(string|array $databaseAndTable): self
    {
        return $this;
    }
    public function delete(): self
    {
        return $this;
    }
    public function set(string|array $columnName, string $value): self
    {
        return $this;
    }
    public function insert(array $data): self
    {
        return $this;
    }
    
    
    
    public function limit(int $number): self
    {
        return $this;
    }
    public function offset(int $offset = 0): self
    {
        return $this;
    }
    public function groupBy(string|array $columns): self
    {
        return $this;
    }
    public function join(string $table, $first, $operator, $second, $type, $where = false): self
    {
        return $this;
    }
    public function innerJoin(string $table, $first, $operator, $second): self
    {
        return $this;
    }
    public function leftJoin(string $table, $first, $operator, $second): self
    {
        return $this;
    }
    public function rightJoin(string $table, $first, $operator, $second): self
    {
        return $this;
    }
    public function crossJoin(string $table, $first, $operator, $second): self
    {
        return $this;
    }
    public function innerJoinWhere(string $table, $first, $operator, $second): self
    {
        return $this;
    }
    public function leftJoinWhere(string $table, $first, $operator, $second): self
    {
        return $this;
    }
    public function rightJoinWhere(string $table, $first, $operator, $second): self
    {
        return $this;
    }
    public function crossJoinWhere(string $table, $first, $operator, $second): self
    {
        return $this;
    }

    public function exportWhereStatments(): array
    {
        return [];
    }
    public function build(DatabaseType $databaseType): ReadyQuery
    {
        return (new ReadyQuery());
    }
    public function asyncBuild(DatabaseType $databaseType): Future
    {
        return new Future(new FutureState);
    }
}
