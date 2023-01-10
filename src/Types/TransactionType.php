<?php

namespace Wsudo\PhpQueryBuilder\Types;
use Wsudo\PhpQueryBuilder\Throwables\Exception;

enum TransactionType 
{
    case READ_UNCOMMITED;
    case READ_COMMITTED;
    case REPEATABLE_READ;
    case SERIALIZABLE;

    public static function toString(TransactionType $transactionType)
    {
        return match ($transactionType) {
            TransactionType::READ_COMMITTED => "READ_COMMITTED" , 
            TransactionType::REPEATABLE_READ => "REPEATABLE_READ" , 
            TransactionType::REPEATABLE_READ => "REPEATABLE_READ" , 
            TransactionType::SERIALIZABLE => "SERIALIZABLE" , 
            default => throw new Exception("transaction type not supported")
        };
    }

    public static function toType(string|TransactionType $transactionType)
    {
        if ($transactionType instanceof TransactionType) {
            return $transactionType;
        }

        return match (mb_strtolower($transactionType)) {
            "read_uncommit" => TransactionType::READ_UNCOMMITED,
            "read_committed" => TransactionType::READ_COMMITTED,
            "repeatable_committed" => TransactionType::REPEATABLE_READ,
            "serilizable" => TransactionType::SERIALIZABLE,
            default => throw new Exception("transaction type not supported"),
        };
    }
}
