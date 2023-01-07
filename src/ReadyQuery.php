<?php

namespace Wsudo\PhpQueryBuilder;

use Wsudo\PhpQueryBuilder\Interfaces\ReadyQueryInterface;

class ReadyQuery implements ReadyQueryInterface
{
    public string $queryString = "";
    public array $bindings = [];

    public function __construct(string $queryString = "", array $bindings = [])
    {
        if (is_string($queryString)) {
            $this->queryString = $queryString;
        }
        if (is_array($bindings)) {
            $this->bindings = $bindings;
        }
    }
    public function getQueryString(): string
    {
        return $this->queryString;
    }
    public function setQueryString(string $queryString): self
    {
        $this->queryString = $queryString;
        return $this;
    }
    public function getBindings(): array
    {
        return $this->bindings;
    }
    public function setBindings(array $bindings): self
    {
        $this->bindings = $bindings;
        return $this;
    }

    public function hasBindings(): bool
    {
        return count($this->bindings) > 0;
    }
}
