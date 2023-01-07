<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;
use Amp\Future;
use Wsudo\PhpQueryBuilder\Interfaces\QueryBuilderInterface;

trait Where
{
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
}

