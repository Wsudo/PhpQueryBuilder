<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;

trait OrderBy
{
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
}
