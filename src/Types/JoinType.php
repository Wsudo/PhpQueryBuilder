<?php

namespace Wsudo\PhpQueryBuilder\Types;
use Wsudo\PhpQueryBuilder\Throwables\Exception;

enum JoinType
{
    case Inner;
    case Left;
    case Right;
    case Cross;

    public static function toString(JoinType $joinType)
    {
        return match ($joinType) {
            JoinType::Inner => "Inner" ,
            JoinType::Left => "Left" ,
            JoinType::Right => "Right" ,
            JoinType::Cross => "Cross" ,
            default => throw new Exception("joinType not supported")
        };
    }

}

