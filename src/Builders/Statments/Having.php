<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;
use Amp\Future;
use Wsudo\PhpQueryBuilder\Interfaces\QueryBuilderInterface;

trait Having
{
    public function having(string $functionName, $arguments = [], string|array $operator, string|array $values): self
    {
        return $this;
    }
}
