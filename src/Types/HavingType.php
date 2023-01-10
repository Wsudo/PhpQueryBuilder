<?php

namespace Wsudo\PhpQueryBuilder\Types;
use Wsudo\PhpQueryBuilder\Throwables\Exception;

enum HavingType
{
    case Functional;
    case FunctionalWithoutArgs;
    case Raw;

    public static function toString(HavingType $havingType)
    {
        return match ($havingType) {
            HavingType::Functional => "Functional",
            HavingType::FunctionalWithoutArgs => "FunctionalWithoutArgs",
            HavingType::Raw => "Raw",
            default => throw new Exception("havingType not supported"),
        };
    }
}
