<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;

use Wsudo\PhpQueryBuilder\Throwables\InvalidValueError;
use Wsudo\PhpQueryBuilder\Types\HavingType;

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

        if(empty($functionName) || str_contains($functionName , " "))
        {
            throw new InvalidValueError("sql function name must be valid ID name , string and not be empty , invalid passed to " . __METHOD__);
        }

        $type = empty($arguments) ? HavingType::FunctionalWithoutArgs : HavingType::Functional;

        $this->havings[] = ['type' => $type, 'function' => $functionName, 'arguments' => $arguments, 'operator' => $operator, 'values' => $values, 'bindings' => $values];

        return $this;
    }
}
