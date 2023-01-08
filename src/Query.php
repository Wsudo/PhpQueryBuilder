<?php

namespace Wsudo\PhpQueryBuilder;

use Wsudo\PhpQueryBuilder\Builders\Query as BuildersQuery;
use Wsudo\PhpQueryBuilder\Throwables\Exception;

final class Query
{
    /**
     * set enable storing queries or not
     * @var bool
     */
    private static bool $storeQueriesEnabled = false;

    /**
     * maximum number of Queries to store
     * 
     * NOTE: it will pop the oldest Query from storedQueries
     * @var int
     * 
     */
    private static int $maxStoredQueries = 10;

    /**
     * stored Queries for debug or something like that
     * 
     * NOTE: it will store multiple type of Queries like (WhereOnlyQuery , fullQueryBuilder , etc)
     * @var array
     */
    private static array $storedQueries = [];

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
                self::$taggedQueries[$name] = self::newFullQueryBuilderInterface();
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
    public static function newFullQueryBuilderInterface():BuildersQuery
    {
        return self::addStoredQuery(new BuildersQuery());
    }

    public static function debug()
    {
        return self::$taggedQueries;
    }
}
