<?php

namespace Wsudo\PhpQueryBuilder\Types;

use Exception;

enum JoinOnType
{
    case On;
    case Where;

    public static function toString(JoinOnType $joinOnType)
    {
        return match ($joinOnType) {
            JoinOnType::On => "On" ,
            JoinOnType::Where => "Where" ,
            default => throw new Exception("joinOnType not supported !") ,
        };
    }

    public static function toType(string|JoinOnType $joinOnType)
    {
        if ($joinOnType instanceof JoinOnType) {
            return $joinOnType;
        }

        return match (mb_strtolower($joinOnType)) {
            "on" => JoinOnType::On,
            "where" => JoinOnType::Where,
            default => throw new Exception("joinOnType not supported !") ,
        };
    }
}

