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
            WhereType::Basic => "Basic" ,
            WhereType::Nested => "Nested" ,
            WhereType::SubQuery => "SubQuery" ,
            WhereType::In => "In" ,
            WhereType::NotIn => "NotIn" ,
            WhereType::Between => "Between" ,
            WhereType::NotBetween => "NotBetween" ,
            WhereType::IsNull => "IsNull" ,
            WhereType::IsNotNull => "IsNotNull" ,
            default => throw new Exception("whereType not supported !")
        };
    }
}

