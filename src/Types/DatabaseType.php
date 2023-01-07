<?php

namespace Wsudo\PhpQueryBuilder\Types;
use Wsudo\PhpQueryBuilder\Exceptions\DatabaseTypeNotSupportedException;

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
            default => throw new DatabaseTypeNotSupportedException("database type not support")
        };
    }
}

