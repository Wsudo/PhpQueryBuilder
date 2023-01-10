<?php

namespace Wsudo\PhpQueryBuilder\Types;

use Wsudo\PhpQueryBuilder\Throwables\Exception;

enum BooleanType
{
    case And;
    case Or;

    public static function toString(BooleanType $booleanType)
    {
        return match ($booleanType) {
            BooleanType::And => "And",
            BooleanType::Or => "Or",
            default => throw new Exception("booleanType not supported"),
        };
    }

    public static function toType(string|BooleanType $booleanType)
    {
        if($booleanType instanceof BooleanType)
        {
            return $booleanType;
        }
        
        return match(mb_strtolower($booleanType))
        {
            "and" => BooleanType::And ,
            'or' => BooleanType::Or,
            default => throw new Exception("booleanType not supported")
        };
    }
}
