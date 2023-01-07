<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;

trait Join
{
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
}

