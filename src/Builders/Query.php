<?php

namespace Wsudo\PhpQueryBuilder\Builders;

use Amp\Future;
use Amp\Internal\FutureState;
use Wsudo\PhpQueryBuilder\Builders\Statments\GroupBy;
use Wsudo\PhpQueryBuilder\Builders\Statments\Having;
use Wsudo\PhpQueryBuilder\Builders\Statments\Join;
use Wsudo\PhpQueryBuilder\Builders\Statments\Limit;
use Wsudo\PhpQueryBuilder\Builders\Statments\OrderBy;
use Wsudo\PhpQueryBuilder\Builders\Statments\Where;
use Wsudo\PhpQueryBuilder\Interfaces\QueryBuilderInterface;
use Wsudo\PhpQueryBuilder\ReadyQuery;
use Wsudo\PhpQueryBuilder\Throwables\InvalidValueError;
use Wsudo\PhpQueryBuilder\Types\DatabaseType;

class Query implements QueryBuilderInterface
{
    use Where;
    use Having;
    use OrderBy;
    use Join;
    use Limit;
    use GroupBy;
    public string $database;
    public string $table;
    public array $wheres =[];
    public array $havings =[];
    public array $joins =[];
    public array $selectedColumns = [];
    public array $updatedData = [];
    public array $insertedData = [];
    public int $limit;
    public int $offset;
    public array $orders = [];
    public string $orderType;
    public array $groups = [];

    public bool $isCount = false;
    public bool $isDelete = false;
    public bool $isUpdate = false;
    public bool $isInsert = false;

    /**
     * set the working database for QueryBuilder
     * 
     * 
     * @param string|array $databaseName  'database' or 'database.table' or ['database' , 'table']
     * @throws InvalidValueError
     * @return Query self instance
     */
    public function database(string|array $databaseName): self
    {
        if(is_string($databaseName))
        {
            if(str_contains("." , $databaseName))
            {
                $explode = explode(".", $databaseName);
                if(count($explode) != 2 || empty($explode[0]) || empty($explode[1]))
                {
                    throw new InvalidValueError("invalid database name given in " . __METHOD__);
                }
                $this->database($explode[0]);
                $this->table($explode[1]);
                return $this;
            }

            $this->database = $databaseName;
        }

        if(is_array($databaseName))
        {
            if(
                !isset($databaseName[0]) || 
                !isset($databaseName[1]) || 
                empty($databaseName[0]) ||
                empty($databaseName[1])
            )
            {
                throw new InvalidValueError("invalid database name given in " . __METHOD__ . " it should be like ['database' , 'table']");
            }
            $this->database = $databaseName[0];
            $this->table($databaseName[1]);
        }

        return $this;
    }

    /**
     * set the working table to the QueryBuilder
     * @param string|array $tableName 'my_table' or 'database.table' or ['database' , 'table']
     * @return Query
     */
    public function table(string|array $tableName): self
    {
        if(is_array($tableName))
        {
            $this->database($tableName);
        }

        if(is_string($tableName))
        {
            if(str_contains("." , $tableName))
            {
                $this->database($tableName);
                return $this;
            }
            $this->table = $tableName;
        }

        return $this;
    }

    /**
     * set which column(s) do you want to select
     * @param string|array $columns 'id' or ['id' ,'name']
     * @throws InvalidValueError
     * @return Query
     */
    public function select(string|array $columns): self
    {
        if(is_string($columns))
        {
            $columns = trim($columns);

            if(empty($columns))
            {
                throw new InvalidValueError("invalid column name passed to the " . __METHOD__);
            }

            if(in_array($columns , $this->selectedColumns))
            {
                return $this;
            }

            $this->selectedColumns[] = $columns;
        }

        if(is_array($columns))
        {
            foreach($columns as $column)
            {
                $this->select($column);
            }
        }

        return $this;
    }

    /**
     * set query is for counting rows
     * 
     * IMPORTANT : this method will be clean all selected Columns from the queryString
     * IMPORTANT : this method will be use just for counting the rows in the table and nothing else !!!
     * 
     * @return Query
     */
    public function count(): self
    {
        $this->selectedColumns = [];
        $this->isCount = true;
        return $this;
    }

    /**
     * set database and table which you want to select rows from !
     * @param string|array $databaseAndTable 'database.table' or 'table' or ['database' , 'table']
     * @return Query
     */
    public function from(string|array $databaseAndTable): self
    {
        $this->table($databaseAndTable);
        return $this;
    }

    /**
     * set the query type as DELETE query
     * 
     * NOTE: this method used just for change select query to the delete query
     * @return Query
     */
    public function delete(): self
    {
        $this->isDelete = true;
        return $this;
    }

    /**
     * set row datas for UPDATE query
     * 
     * NOTE: when you passed $columnName as key-value array method will not use $value argument
     * and it will use array values to set row-columns values
     * 
     * NOTE: this method will modify query type to UPDATE query type
     * 
     * @param string|array $columnName 'name' or ['name' => 'John']
     * @param string|null $value value of the column
     * @throws InvalidValueError
     * @return Query
     */
    public function set(string|array $column, string $value = null): self
    {
        $this->isUpdate = true;

        if(is_string($column))
        {
            $column = trim($column);

            if(empty($column))
            {
                throw new InvalidValueError("invalid column name passed to " . __METHOD__);
            }
            if(!is_null($value) && !is_string($value))
            {
                throw new InvalidValueError("invalid value type passed to " . __METHOD__);
            }

            $this->updatedData[$column] = $value;
        }
        
        if(is_array($column) && !empty($column))
        {
            foreach($column as $name => $value)
            {
                $this->set($name, $value);
            }
        }

        return $this;
    }

    /**
     * add insert data to the Query Builder
     * 
     * NOTE: there will use for INSERT data 
     * 
     * NOTE: it will change Query Type to the INSERT query Type
     * 
     * NOTE: when you passed $column as key-value array method will not use $value argument
     * and it will use array values to set row-columns values
     * 
     * @param string|array $column 'name' or ['name' => 'John']
     * @param string|null $value $value value of the column
     * @throws InvalidValueError
     * @return Query
     */
    public function insert(string|array $column , string $value = null): self
    {
        $this->isInsert = true;

        if(is_string($column))
        {
            $column = trim($column);

            if(empty($column))
            {
                throw new InvalidValueError("invalid column name passed to " . __METHOD__);
            }
            if(!is_null($value) && !is_string($value))
            {
                throw new InvalidValueError("invalid value type passed to " . __METHOD__);
            }

            $this->insertedData[$column] = $value;
        }
        
        if(is_array($column) && !empty($column))
        {
            foreach($column as $name => $value)
            {
                $this->set($name, $value);
            }
        }
        return $this;
    }
    
    public function build(DatabaseType $databaseType): ReadyQuery
    {
        return (new ReadyQuery());
    }
    public function asyncBuild(DatabaseType $databaseType): Future
    {
        return new Future(new FutureState);
    }
}
