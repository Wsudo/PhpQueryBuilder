<?php

namespace Wsudo\PhpQueryBuilder\Builders;

use Amp\Future;
use Amp\Internal\FutureState;
use Wsudo\PhpQueryBuilder\Interfaces\QueryBuilderInterface;
use Wsudo\PhpQueryBuilder\ReadyQuery;
use Wsudo\PhpQueryBuilder\Types\DatabaseType;

class Query implements QueryBuilderInterface
{

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
    public function where(string|\Closure|Future|QueryBuilderInterface $column, $operator, $value, string $bool): self
    {
        return $this;
    }
    public function orWhere(string|\Closure|Future|QueryBuilderInterface $column, $operator, $value): self
    {
        return $this;
    }
    public function whereNot($column, $value, string $bool): self
    {
        return $this;
    }
    public function orWhereNot($column, $value): self
    {
        return $this;
    }
    public function whereIn(string $column, array $value, string $bool): self
    {
        return $this;
    }
    public function whereNotIn(string $column, array $value, string $bool): self
    {
        return $this;
    }
    public function orWhereIn(string $column, array $value): self
    {
        return $this;
    }
    public function orWhereNotIn(string $column, array $value): self
    {
        return $this;
    }
    public function whereBetween(string|\Closure|Future|QueryBuilderInterface $column, string|\Closure|Future|QueryBuilderInterface $first, string|\Closure|Future|QueryBuilderInterface $second, string $bool, bool $not): self
    {
        return $this;
    }
    public function orWhereBetween($column, $first, $second): self
    {
        return $this;
    }
    public function whereNotBetween($column, $first, $second, string $bool): self
    {
        return $this;
    }
    public function orWhereNotBetween($column, $first, $second): self
    {
        return $this;
    }
    public function whereNull($column, string $bool): self
    {
        return $this;
    }
    public function orWhereNull($column): self
    {
        return $this;
    }
    public function whereNotNull($column, string $bool): self
    {
        return $this;
    }
    public function orWhereNotNull($column): self
    {
        return $this;
    }
    public function whereSub(\Closure|Future|QueryBuilderInterface $queryBuilder, string $bool): self
    {
        return $this;
    }
    public function orWhereSub(\Closure|Future|QueryBuilderInterface $queryBuilder): self
    {
        return $this;
    }
    public function having(string $functionName, $arguments = [], string|array $operator, string|array $values): self
    {
        return $this;
    }
    public function orderBy(string|array $columns): self
    {
        return $this;
    }
    public function orderByDesc(string|array $columns): self
    {
        return $this;
    }
    public function orderByAsc(string|array $columns): self
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
