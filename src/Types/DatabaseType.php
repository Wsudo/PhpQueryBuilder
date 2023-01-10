<?php

namespace Wsudo\PhpQueryBuilder\Types;

use Wsudo\PhpQueryBuilder\Throwables\DatabaseTypeNotSupportedException;

enum DatabaseType
{
    case MYSQL;
    case SQLITE;
    case POSTGRESQL;
    case MSSQL;

    public static function toString(DatabaseType $databaseType)
    {
        return match ($databaseType) {
            DatabaseType::MYSQL => "MYSQL",
            DatabaseType::SQLITE => "SQLITE",
            DatabaseType::POSTGRESQL => "POSTGRESQL",
            DatabaseType::MSSQL => "MSSQL",
            default => throw new DatabaseTypeNotSupportedException("database type not support")
        };
    }

    public static function toType(string|DatabaseType $databaseType)
    {
        if ($databaseType instanceof DatabaseType) {
            return $databaseType;
        }

        return match (mb_strtolower($databaseType)) {
            "mysql" => DatabaseType::MYSQL,
            "sqlite" => DatabaseType::SQLITE,
            "postgresql" => DatabaseType::POSTGRESQL,
            "mssql" => DatabaseType::MSSQL,
            default => throw new DatabaseTypeNotSupportedException("databaseType not supported")
        };
    }
}
