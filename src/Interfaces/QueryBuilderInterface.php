<?php

namespace Wsudo\PhpQueryBuilder\Interfaces;

use Amp\Future;
use Wsudo\PhpQueryBuilder\ReadyQuery;
use Wsudo\PhpQueryBuilder\Types\DatabaseType;

interface QueryBuilderInterface
{
    public function database(string|array $databaseName): self;
    public function table(string|array $tableName): self;
    public function select(string|array $columns): self;
    public function count():self;
    public function from(string|array $databaseAndTable): self;
    public function delete(): self;
    public function set(string|array $column, string $value): self;
    public function insert(string|array $column , string $value = null): self;
    public function where(string|\Closure|Future|QueryBuilderInterface $column, $operator, $value, string $bool): self;
    public function orWhere(string|\Closure|Future|QueryBuilderInterface $column, $operator, $value): self;
    public function whereNot($column, $value, string $bool): self;
    public function orWhereNot($column, $value): self;
    public function whereIn(string $column, array $value, string $bool): self;
    public function whereNotIn(string $column, array $value, string $bool): self;
    public function orWhereIn(string $column, array $value): self;
    public function orWhereNotIn(string $column, array $value): self;
    public function whereBetween(string|\Closure|Future|QueryBuilderInterface $column, string|\Closure|Future|QueryBuilderInterface $first, string|\Closure|Future|QueryBuilderInterface $second, string $bool , bool $not): self;
    public function orWhereBetween($column, $first, $second): self;
    public function whereNotBetween($column, $first, $second, string $bool): self;
    public function orWhereNotBetween($column, $first, $second): self;
    public function whereNull($column, string $bool): self;
    public function orWhereNull($column): self;
    public function whereNotNull($column, string $bool): self;
    public function orWhereNotNull($column): self;
    public function whereSub(\Closure|Future|QueryBuilderInterface $queryBuilder, string $bool): self;
    public function orWhereSub(\Closure|Future|QueryBuilderInterface $queryBuilder): self;
    public function having(string $functionName,array|string|int|float $arguments , string|array $operator, string|array $values): self;
    public function orderBy(string|array $columns): self;
    public function orderByDesc(string|array $columns): self;
    public function orderByAsc(string|array $columns): self;
    public function limit(int $number):self;
    public function offset(int $number):self;
    public function groupBy(string|array $columns): self;
    public function join(string $table, $first, $operator, $second, $type, $where = false):self;
    public function innerJoin(string $table, $first, $operator, $second):self;
    public function leftJoin(string $table, $first, $operator, $second):self;
    public function rightJoin(string $table, $first, $operator, $second):self;
    public function crossJoin(string $table, $first, $operator, $second):self;
    public function innerJoinWhere(string $table, $first, $operator, $second):self;
    public function leftJoinWhere(string $table, $first, $operator, $second):self;
    public function rightJoinWhere(string $table, $first, $operator, $second):self;
    public function crossJoinWhere(string $table, $first, $operator, $second):self;
    public function build(DatabaseType $databaseType): ReadyQuery;
    public function asyncBuild(DatabaseType $databaseType): Future;

}
