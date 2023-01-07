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
    public $database;
    public $table;
    public $wheres;
    public $havings;
    public $joins;

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
    public function select(string|array $columns): self
    {
        return $this;
    }
    public function count(): self
    {
        return $this;
    }
    public function from(string|array $databaseAndTable): self
    {
        return $this;
    }
    public function delete(): self
    {
        return $this;
    }
    public function set(string|array $columnName, string $value): self
    {
        return $this;
    }
    public function insert(array $data): self
    {
        return $this;
    }
    public function exportWhereStatments(): array
    {
        return [];
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
