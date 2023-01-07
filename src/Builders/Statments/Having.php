<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;

trait Having
{
    public function having(string $functionName, $arguments = [], string|array $operator, string|array $values): self
    {
        return $this;
    }
}
