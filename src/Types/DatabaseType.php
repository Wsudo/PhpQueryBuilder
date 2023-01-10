<?php

namespace Wsudo\PhpQueryBuilder\Types;

use Exception;
use Wsudo\PhpQueryBuilder\Throwables\DatabaseTypeNotSupportedException as ThrowablesDatabaseTypeNotSupportedException;

enum DatabaseType
{
    case MYSQL;
    case SQLITE;
    case POSTGRESQL;
    case MSSQL;

    public static function toString(DatabaseType $databaseType)
    {
        return match ($databaseType) {
            DatabaseType::MYSQL => "MYSQL" ,
            DatabaseType::SQLITE => "SQLITE" ,
            DatabaseType::POSTGRESQL => "POSTGRESQL" ,
            DatabaseType::MSSQL => "MSSQL" ,
            default => throw new ThrowablesDatabaseTypeNotSupportedException("database type not support")
        };
    }
}

