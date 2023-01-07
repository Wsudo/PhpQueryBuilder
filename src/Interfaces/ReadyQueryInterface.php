<?php

namespace Wsudo\PhpQueryBuilder\Interfaces;


interface ReadyQueryInterface
{
    public function getQueryString(): string;
    public function setQueryString(string $queryString): self;
    public function getBindings(): array;
    public function setBindings(array $bindings): self;
}

