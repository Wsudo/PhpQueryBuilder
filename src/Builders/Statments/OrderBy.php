<?php

namespace Wsudo\PhpQueryBuilder\Builders\Statments;

use Wsudo\PhpQueryBuilder\Throwables\InvalidValueError;

trait OrderBy
{
    /**
     * set orderby columns for SELECT Query Type
     * 
     * NOTE: this will be modify query Type to the SELECT query type
     * 
     * 
     * @param string|array $columns 'id' or ['id' , 'age']
     * @throws InvalidValueError
     * @return self
     */
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

    /**
     * set orderby columns and order type to DESC for SELECT Query Type
     * 
     * NOTE: this will be modify query Type to the SELECT query type
     * 
     * @param string|array $columns 'id' or ['id' , 'age']
     * @return self
     */
    public function orderByDesc(string|array $columns): self
    {
        $this->orderType = "DESC";
        return $this->orderBy($columns);
    }
    public function orderByAsc(string|array $columns): self
    {
        $this->orderType = "ASC";
        return $this->orderBy($columns);
    }
}
