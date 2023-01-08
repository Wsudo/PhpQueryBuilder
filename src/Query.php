<?php

namespace Wsudo\PhpQueryBuilder;

final class Query
{
    private static $storeQueriesEnabled = false;
    private static int $maxStoredQueries = 10;
    private static array $storedQueries = [];
    private static array $taggedQueries = [];
}
