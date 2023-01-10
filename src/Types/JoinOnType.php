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
}

