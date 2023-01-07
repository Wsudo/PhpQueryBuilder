<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;

use Wsudo\PhpQueryBuilder\Throwables\InvalidValueError;

trait GroupBy
{
    /**
     * add groupBy column statment into the SELECT query
     * 
     * NODE: this will be change Query type to the SELECT Query
     * @param string|array $columns
     * @throws InvalidValueError
     * @return self
     */
    public function groupBy(string|array $columns): self
    {
        $this->isSelect = true;

        if(is_string($columns))
        {
            $columns = trim($columns);
            if(empty($columns))
            {
                throw new InvalidValueError("column name must be string and not empty , invalid passed to " . __METHOD__);
            }
            $this->groups[] = $columns;
        }

        if(is_array($columns))
        {
            foreach($columns as $column)
            {
                $this->groupBy($column);
            }
        }

        return $this;
    }
}
