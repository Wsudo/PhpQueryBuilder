<?php

namespace Wsudo\PhpQueryBuilder;

use Amp\Future;
use Wsudo\PhpQueryBuilder\Builders\Query as BuildersQuery;
use Wsudo\PhpQueryBuilder\Builders\Transaction;
use Wsudo\PhpQueryBuilder\Interfaces\QueryBuilderInterface;
use Wsudo\PhpQueryBuilder\Throwables\Exception;
use Wsudo\PhpQueryBuilder\Types\TransactionType;

final class Query
{
    /**
     * set enable storing queries or not
     * @var bool
     */
    private static bool $storeQueriesEnabled = false;

    /**
     * set enable storing Transactions queries or not
     * @var bool
     */
    private static bool $storeTransactionsEnabled = false;

    /**
     * maximum number of Queries to store
     * 
     * NOTE: it will shit the oldest Query from storedQueries
     * @var int
     * 
     */
    private static int $maxStoredQueries = 10;

    /**
     * maximum number of Transactions Queries to store
     * 
     * NOTE: it will shit the oldest Transactions Query from storedQueries
     * @var int
     */
    private static int $maxStoredTransactions = 10;

    /**
     * stored Queries for debug or something like that
     * 
     * NOTE: it will store multiple type of Queries like (WhereOnlyQuery , fullQueryBuilder , etc)
     * @var array
     */
    private static array $storedQueries = [];

    /**
     * stored Queries for debug or something like that
     * 
     * NOTE: it will Transactions Queries
     * @var array
     */
    private static array $storedTransactions = [];

    /**
     * storage of tagged Queries
     * 
     * tagged Queries are usefull to use Queries Again and Update them
     * @var array
     */
    private static array $taggedQueries = [];

    /**
     * set StoreQueriesEnabled
     * @param bool $enabled
     * @return Query
     */
    public static function setStoreQueriesEnabled(bool $enabled = true):self
    {
        self::$storeQueriesEnabled = $enabled;
        return new static ();
    }

    /**
     * get StoreQueriesEnabled
     * @return bool
     */
    public static function getStoreQueriesEnabled():bool
    {
        return self::$storeQueriesEnabled;
    }

    /**
     * set Store Transactions Enabled
     * @param bool $enabled
     * @return Query
     */
    public static function setStoreTransactionsEnabled(bool $enabled = true):self
    {
        self::$storeTransactionsEnabled = $enabled;
        return new static ();
    }

    /**
     * get Store Transactions Enabled
     * @return bool
     */
    public static function getStoreTransactionsEnabled():bool
    {
        return self::$storeTransactionsEnabled;
    }

    /**
     * set maximum number of Stored Queries
     * @param int $maximumNumber
     * @return Query
     */
    public static function setMaxStoredQueries(int $maximumNumber):self
    {
        self::$maxStoredQueries = $maximumNumber;
        return new static ();
    }
    
    /**
     * get maximum number of Stored Queries
     * @return int
     */
    public static function getMaxStoredQueries():int
    {
        return self::$maxStoredQueries;
    }

    /**
     * set maximum number of Stored Transactions Queries
     * @param int $maximumNumber
     * @return Query
     */
    public static function setMaxStoredTransactions(int $maximumNumber):self
    {
        self::$maxStoredTransactions = $maximumNumber;
        return new static ();
    }
    
    /**
     * get maximum number of Transaction Queries
     * @return int
     */
    public static function getMaxStoredTransactions():int
    {
        return self::$maxStoredTransactions;
    }

    /**
     * set Stored Queries
     * @param array $storedQueries
     * @return Query
     */
    public static function setStoredQueries(array $storedQueries):self
    {
        self::$storedQueries = $storedQueries;
        return new static ();
    }

    /**
     * get Stored Queries
     * @return array
     */
    public static function getStoredQueries():array
    {
        return self::$storedQueries;
    }

    /**
     * add new query to the stored Query list
     * @param BuildersQuery $query
     * @return BuildersQuery
     */
    public static function addStoredQuery(BuildersQuery $query):BuildersQuery
    {

        if(!self::$storeQueriesEnabled)
        {
            return $query;
        }

        if(count(self::$storedQueries) >= self::$maxStoredQueries)
        {
            array_shift(self::$storedQueries);
        }
        self::$storedQueries[] = $query;
        return self::$storedQueries[count(self::$storedQueries) -1];
    }

    /**
     * check has any storedQuery or not
     * @return bool
     */
    public static function hasStoredQuery():bool
    {
        return count(self::$storedQueries) > 0;
    }

    /**
     * set Stored Queries
     * @param array $storedQueries
     * @return self
     */
    public static function setStoredTransactions(array $storedTransactions):self
    {
        self::$storedTransactions = $storedTransactions;
        return new static ();
    }

    /**
     * get Stored Transactions
     * @return array
     */
    public static function getStoredTransactions():array
    {
        return self::$storedTransactions;
    }

    /**
     * add new Transaction to the stored Query list
     * @param Transaction $query
     * @return Transaction
     */
    public static function addStoredTransaction(Transaction $query):Transaction
    {

        if(!self::$storeTransactionsEnabled)
        {
            return $query;
        }

        if(count(self::$storedTransactions) >= self::$maxStoredTransactions)
        {
            array_shift(self::$storedTransactions);
        }
        self::$storedTransactions[] = $query;
        return self::$storedTransactions[count(self::$storedTransactions) -1];
    }

    /**
     * check has any Transaction or not
     * @return bool
     */
    public static function hasStoredTransaction():bool
    {
        return count(self::$storedTransactions) > 0;
    }

    /**
     * set tagget Queries
     * @param array $taggedQueries
     * @return Query
     */
    public static function setTaggetQueries(array $taggedQueries) : self
    {
        self::$taggedQueries = $taggedQueries;
        return new static ();
    }

    /**
     * get taggedQueries
     * @return array
     */
    public static function getTaggetQueries():array
    {
        return self::$taggedQueries;
    }

    /**
     * return tagged Query instance or false
     * 
     * @param string|int $name
     * @param mixed $ignore
     * @throws Exception if tagged Query does not exists and $ignore = true will throw error
     * @return BuildersQuery|BuildersQuery|bool false if tagged Query does not exists
     */
    public static function tagged(string|int $name , $ignore = true):BuildersQuery|bool
    {
        if(isset(self::$taggedQueries[$name]))
        {
            return self::$taggedQueries[$name];
        }
        
        if(!$ignore)
        {
            throw new Exception("tagget '" . $name . "' Query is not exists");
        }

        return false;
    }

    /**
     * tag the query/new-query as its name
     * 
     * 
     * @param string|int $name
     * @param BuildersQuery|null $queryBuilder
     * @param mixed $replace
     * @return BuildersQuery
     */
    public static function tag(string|int $name , BuildersQuery $queryBuilder = null , $replace = false):BuildersQuery
    {
        if(!isset(self::$taggedQueries[$name])) {
            if($queryBuilder == null)
            {
                self::$taggedQueries[$name] = self::newFullQueryBuilder();
                return self::$taggedQueries[$name];
            }
            self::$taggedQueries[$name] = $queryBuilder;
            return self::$taggedQueries[$name];
        }
        
        if($queryBuilder != null && !$replace)
        {
            trigger_error("tagged query was seted and will be return , because of replacement is passed as false !", E_USER_WARNING);
            return self::$taggedQueries[$name];
        }

        if($queryBuilder == null)
        {
            return self::$taggedQueries[$name];
        }

        self::$taggedQueries[$name] = $queryBuilder;
        return self::$taggedQueries[$name];
    }

    /**
     * create and set new FullQueryBuilder Instance and return it out
     * @return BuildersQuery
     */
    public static function newFullQueryBuilder():BuildersQuery
    {
        return self::addStoredQuery(new BuildersQuery());
    }

    /**
     * create new Transaction and return it out
     * 
     * NOTE: if store Tranaction Enabled it will be store in the list of transactions
     * @param TransactionType|null $transactionType
     * @return Transaction
     */
    public static function newTransaction(TransactionType $transactionType = null):Transaction
    {
        return self::addStoredTransaction(new Transaction($transactionType));
    }

    public static function debug()
    {
        return self::$taggedQueries;
    }

    public static function database(string|array $database):BuildersQuery
    {
        return self::newFullQueryBuilder()->database($database);
    }
    public static function table(string|array $table):BuildersQuery
    {
        return self::newFullQueryBuilder()->table($table);
    }
    public static function select(string|array $columns): BuildersQuery
    {
        return self::newFullQueryBuilder()->select($columns);
    }
    public static function count():BuildersQuery
    {
        return self::newFullQueryBuilder()->count();
    }
    public static function from(string|array $databaseAndTable): BuildersQuery
    {
        return self::newFullQueryBuilder()->from($databaseAndTable);
    }
    public static function to(string|array $databaseAndTable): BuildersQuery
    {
        return self::newFullQueryBuilder()->to($databaseAndTable);
    }
    public static function delete(): BuildersQuery
    {
        return self::newFullQueryBuilder()->delete();
    }
    public static function set(string|array $column, string $value): BuildersQuery
    {
        return self::newFullQueryBuilder()->set($column , $value);
    }
    public static function insert(string|array $column , string $value): BuildersQuery
    {
        return self::newFullQueryBuilder()->insert($column , $value);
    }
    public static function where(string|\Closure|Future|QueryBuilderInterface $column, $operator, $value, string $bool): BuildersQuery
    {
        return self::newFullQueryBuilder()->where($column, $operator, $value, $bool);
    }
    public static function orWhere(string|\Closure|Future|QueryBuilderInterface $column, $operator, $value): BuildersQuery
    {
        return self::newFullQueryBuilder()->orWhere($column, $operator, $value);
    }
    public static function whereNot($column, $value, string $bool): BuildersQuery
    {
        return self::newFullQueryBuilder()->orWhere($column, $value, $bool);
    }
    public static function orWhereNot($column, $value): BuildersQuery
    {
        return self::newFullQueryBuilder()->orWhereNot($column, $value);
    }
    public static function whereIn(string $column, array $value, string $bool): BuildersQuery
    {
        return self::newFullQueryBuilder()->whereIn($column, $value,$bool);
    }
    public static function whereNotIn(string $column, array $value, string $bool): BuildersQuery
    {
        return self::newFullQueryBuilder()->whereNotIn($column, $value,$bool);
    }
    public static function orWhereIn(string $column, array $value): BuildersQuery
    {
        return self::newFullQueryBuilder()->orWhereIn($column, $value);
    }
    public static function orWhereNotIn(string $column, array $value): BuildersQuery
    {
        return self::newFullQueryBuilder()->orWhereNotIn($column, $value);
    }
    public static function whereBetween(string|\Closure|Future|QueryBuilderInterface $column, string|\Closure|Future|QueryBuilderInterface $first, string|\Closure|Future|QueryBuilderInterface $second, string $bool , bool $not): BuildersQuery
    {
        return self::newFullQueryBuilder()->whereBetween($column, $first , $second , $bool , $not);
    }
    public static function orWhereBetween($column, $first, $second): BuildersQuery
    {
        return self::newFullQueryBuilder()->orWhereBetween($column, $first , $second);
    }
    public static function whereNotBetween($column, $first, $second, string $bool): BuildersQuery
    {
        return self::newFullQueryBuilder()->whereNotBetween($column, $first , $second , $bool);
    }
    public static function orWhereNotBetween($column, $first, $second): BuildersQuery
    {
        return self::newFullQueryBuilder()->orWhereNotBetween($column, $first , $second);
    }
    public static function whereNull($column, string $bool): BuildersQuery
    {
        return self::newFullQueryBuilder()->whereNull($column, $bool);
    }
    public static function orWhereNull($column): BuildersQuery
    {
        return self::newFullQueryBuilder()->orWhereNull($column);
    }
    public static function whereNotNull($column, string $bool): BuildersQuery
    {
        return self::newFullQueryBuilder()->whereNotNull($column, $bool);
    }
    public static function orWhereNotNull($column): BuildersQuery
    {
        return self::newFullQueryBuilder()->orWhereNotNull($column);
    }
    public static function whereSub(\Closure|Future|QueryBuilderInterface $queryBuilder, string $bool): BuildersQuery
    {
        return self::newFullQueryBuilder()->whereSub($queryBuilder , $bool);
    }
    public static function orWhereSub(\Closure|Future|QueryBuilderInterface $queryBuilder): BuildersQuery
    {
        return self::newFullQueryBuilder()->orWhereSub($queryBuilder);
    }
    public static function havingFunc(string $functionName,array|string|int|float $arguments, string|array $operator, string|array $values): BuildersQuery
    {
        return self::newFullQueryBuilder()->havingFunc($functionName , $arguments , $operator , $values);
    }
    public static function orderBy(string|array $columns): BuildersQuery
    {
        return self::newFullQueryBuilder()->orderBy($columns);
    }
    public static function join(string $table, $first, $operator, $second, $type, $where = false):BuildersQuery
    {
        return self::newFullQueryBuilder()->join( $table, $first, $operator, $second, $type, $where);
    }
    public static function innerJoin(string $table, $first, $operator, $second):BuildersQuery
    {
        return self::newFullQueryBuilder()->innerJoin( $table, $first, $operator, $second);
    }
    public static function leftJoin(string $table, $first, $operator, $second):BuildersQuery
    {
        return self::newFullQueryBuilder()->leftJoin( $table, $first, $operator, $second);
    }
    public static function rightJoin(string $table, $first, $operator, $second):BuildersQuery
    {
        return self::newFullQueryBuilder()->rightJoin( $table, $first, $operator, $second);
    }
    public static function crossJoin(string $table, $first, $operator, $second):BuildersQuery
    {
        return self::newFullQueryBuilder()->crossJoin( $table, $first, $operator, $second);
    }
    public static function innerJoinWhere(string $table, $first, $operator, $second):BuildersQuery
    {
        return self::newFullQueryBuilder()->innerJoinWhere( $table, $first, $operator, $second);
    }
    public static function leftJoinWhere(string $table, $first, $operator, $second):BuildersQuery
    {
        return self::newFullQueryBuilder()->leftJoinWhere( $table, $first, $operator, $second);
    }
    public static function rightJoinWhere(string $table, $first, $operator, $second):BuildersQuery
    {
        return self::newFullQueryBuilder()->rightJoinWhere( $table, $first, $operator, $second);
    }
    public static function crossJoinWhere(string $table, $first, $operator, $second):BuildersQuery
    {
        return self::newFullQueryBuilder()->crossJoinWhere( $table, $first, $operator, $second);
    }
}
