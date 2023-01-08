<?php

namespace Wsudo\PhpQueryBuilder;

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

    public static function setStoredQueries(array $storedQueries):self
    {
        self::$storedQueries = $storedQueries;
        return new static ();
    }

    public static function getStoredQueries():array
    {
        return self::$storedQueries;
    }
    
}
