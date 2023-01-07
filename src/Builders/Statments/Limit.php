<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;

trait Limit
{
    public function limit(int $number): self
    {
        return $this;
    }
    public function offset(int $offset = 0): self
    {
        return $this;
    }
}
