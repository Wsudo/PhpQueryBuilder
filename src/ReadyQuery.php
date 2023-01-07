<?php

namespace Wsudo\PhpQueryBuilder;

use Wsudo\PhpQueryBuilder\Interfaces\ReadyQueryInterface;

/**
 * A ReadyQuery Built By QueryBuilder
 */
class ReadyQuery implements ReadyQueryInterface
{
    /**
     * query string built by QueryBuilder with param binding sanitization
     * @var string
     */
    public string $queryString = "";

    /**
     * list of query param bindings sanitized and built by QueryBuilder
     * @var array
     */
    public array $bindings = [];

    /**
     * setup new instance
     * @param string $queryString
     * @param array $bindings
     */
    public function __construct(string $queryString = "", array $bindings = [])
    {
        if (is_string($queryString)) {
            $this->queryString = $queryString;
        }
        if (is_array($bindings)) {
            $this->bindings = $bindings;
        }
    }

    /**
     * get Query string built by QueryBuilder
     * @return string
     */
    public function getQueryString(): string
    {
        return $this->queryString;
    }

    /**
     * set QueryString which is sanitized for param bindings
     * @param string $queryString
     * @return ReadyQuery
     */
    public function setQueryString(string $queryString): self
    {
        $this->queryString = $queryString;
        return $this;
    }

    /**
     * get list of param bindings sanitized by QueryBuilder
     * @return array
     */
    public function getBindings(): array
    {
        return $this->bindings;
    }

    /**
     * set list of param bindings sanitized for QueryString
     * @param array $bindings
     * @return ReadyQuery
     */
    public function setBindings(array $bindings): self
    {
        $this->bindings = $bindings;
        return $this;
    }

    /**
     * check queryString has any param bindings or not
     * @return bool
     */
    public function hasBindings(): bool
    {
        return count($this->bindings) > 0;
    }
}
