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

    public function havingRaw(string $sql, array $paramBindings): self
    {
        $this->isSelect = true;
        
        if(empty($sql))
        {
            throw new InvalidValueError("sql argument must not empty");
        }

        if(empty($paramBindings))
        {
            throw new InvalidValueError("havingRaw should have at least one paramBinding");
        }

        foreach($paramBindings as $index => $paramBinding)
        {
            if(!is_int($index) || $index < 0)
            {
                throw new InvalidValueError("query builder does not support ColumnBinding");
            }
        }

        $this->havings[] = ['type' => HavingType::Raw, 'sql' => $sql, 'bindings' => $paramBinding];

        return $this;

    }
}
