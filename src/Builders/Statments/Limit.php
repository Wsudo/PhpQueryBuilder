<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;
use Wsudo\PhpQueryBuilder\Throwables\InvalidValueError;

trait Limit
{
    /**
     * set limit items for SELECT query type
     * @param int $number number of items per index
     * @throws InvalidValueError
     * @return self
     */
    public function limit(int $number): self
    {
        if($number < 1)
        {
            throw new InvalidValueError("limit number MUST be bigger then zero , invalid passed to " .__METHOD__);
        }
        $this->limit =$number;
        return $this;
    }
    public function offset(int $offset = 0): self
    {
        return $this;
    }
}
