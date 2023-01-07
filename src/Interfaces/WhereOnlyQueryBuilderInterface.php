<?php

namespace Wsudo\PhpQueryBuilder\Interfaces;

use Amp\Future;

interface WhereOnlyQueryBuilderInterface
{
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
    public function exportWhereStatments(): array;
}
