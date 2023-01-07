<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;

use Wsudo\PhpQueryBuilder\Throwables\InvalidValueError;

trait OrderBy
{
    public function orderBy(string|array $columns = ['id']): self
    {
        if(is_string($columns))
        {
            $columns = trim($columns);
            if(empty($columns))
            {
                throw new InvalidValueError("column name must be string and not empty , invalid passed to " . __METHOD__);
            }
            
            if(!in_array($columns , $this->orders))
            {
                $this->orders[] = $columns; 
            }
        }

        if(is_array($columns) && !empty($columns))
        {
            foreach($columns as $column)
            {
                $this->orderBy($column);
            }
        }

        return $this;
    }
    public function orderByDesc(string|array $columns): self
    {
        return $this;
    }
    public function orderByAsc(string|array $columns): self
    {
        return $this;
    }
}
