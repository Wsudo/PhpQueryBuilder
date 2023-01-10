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
            default => throw new Exception("order type not supported !")
        };
    }
}

