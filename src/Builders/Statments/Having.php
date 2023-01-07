<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;

trait Having
{
    public function havingFunc(string $functionName, array|string|int|float $arguments = [], string|array $operator, string|array $values = null): self
    {
        $this->isSelect = true;

        if(is_null($values))
        {
            $values = $operator;
            $operator = "=";
        }



        return $this;
    }
}
