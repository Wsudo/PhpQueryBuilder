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

    public static function toType(string|JoinType $joinType)
    {
        if ($joinType instanceof JoinType) {
            return $joinType;
        }

        return match (mb_strtolower($joinType)) {
            "inner" => JoinType::Inner,
            "left" => JoinType::Left,
            "right" => JoinType::Right,
            "cross" => JoinType::Cross,
            default => throw new Exception("joinType not supported") ,
        };
    }
}

