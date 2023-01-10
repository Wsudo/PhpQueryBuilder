<?php

namespace Wsudo\PhpQueryBuilder\Types;

use Wsudo\PhpQueryBuilder\Throwables\Exception;

enum WhereType
{
    case Basic;
    case Nested;
    case SubQuery;
    case Raw;
    case In;
    case NotIn;
    case Between;
    case NotBetween;
    case IsNull;
    case IsNotNull;

    public static function toString(WhereType $whereType)
    {
        return match ($whereType) {
            WhereType::Basic => "Basic",
            WhereType::Nested => "Nested",
            WhereType::SubQuery => "SubQuery",
            WhereType::In => "In",
            WhereType::NotIn => "NotIn",
            WhereType::Between => "Between",
            WhereType::NotBetween => "NotBetween",
            WhereType::IsNull => "IsNull",
            WhereType::IsNotNull => "IsNotNull",
            default => throw new Exception("whereType not supported")
        };
    }

    public static function toType(string|WhereType $whereType)
    {
        if ($whereType instanceof WhereType) {
            return $whereType;
        }

        return match (mb_strtolower($whereType)) {
            "basic" => WhereType::Basic,
            "nested" => WhereType::Nested,
            "subquery" => WhereType::SubQuery,
            "in" => WhereType::In,
            "notin" => WhereType::NotIn,
            "between" => WhereType::Between,
            "notbetween" => WhereType::NotBetween,
            "isnull" => WhereType::IsNull,
            "isnotnull" => WhereType::IsNotNull,
            default => throw new Exception("whereType not supported"),
        };
    }
}
