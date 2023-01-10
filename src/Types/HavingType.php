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

    public static function toType(string|HavingType $havingType)
    {
        if ($havingType instanceof HavingType) {
            return $havingType;
        }

        return match (mb_strtolower($havingType)) {
            "functional" => HavingType::Functional,
            "functionalwithoutargs" => HavingType::FunctionalWithoutArgs,
            "functional_without_args" => HavingType::FunctionalWithoutArgs,
            "raw" => HavingType::Raw,
            default => throw new Exception("havingType not supported")
        };
    }
}
