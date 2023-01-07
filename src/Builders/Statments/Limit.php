<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;
use Wsudo\PhpQueryBuilder\Throwables\InvalidValueError;

trait Limit
{
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
