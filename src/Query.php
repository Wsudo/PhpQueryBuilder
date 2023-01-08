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
}
