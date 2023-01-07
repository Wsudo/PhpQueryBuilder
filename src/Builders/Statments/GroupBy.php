<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;

trait GroupBy
{
    public function groupBy(string|array $columns): self
    {
        return $this;
    }
}
