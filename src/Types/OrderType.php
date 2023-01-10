<?php

namespace Wsudo\PhpQueryBuilder\Types;
use Wsudo\PhpQueryBuilder\Throwables\Exception;

enum OrderType
{
    case NONE;
    case DESC;
    case ASC;

    public static function toString(OrderType $orderType)
    {
        return match ($orderType) {
            OrderType::NONE => "NONE" ,
            OrderType::DESC => "DESC" ,
            OrderType::ASC => "ASC" ,
            default => throw new Exception("order type not supported")
        };
    }

    public static function toType(string|OrderType $orderType)
    {
        if ($orderType instanceof OrderType) {
            return $orderType;
        }

        return match (mb_strtolower($orderType)) {
            "none" => OrderType::NONE,
            "desc" => OrderType::DESC,
            "asc" => OrderType::ASC,
            default => throw new Exception("order type not supported"),
        };
    }
}

