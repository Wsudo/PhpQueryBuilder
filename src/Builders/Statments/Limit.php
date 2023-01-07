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

    /**
     * set the offset number of rows for SELECT query type
     * @param int $number number of rows offset
     * @throws InvalidValueError
     * @return self
     */
    public function offset(int $number = 0): self
    {
        if($number < 0)
        {
            throw new InvalidValueError("offset number MUST be bigger then -1 , invalid passed to " .__METHOD__);
        }
        $this->offset =$number;
        return $this;
    }
}
