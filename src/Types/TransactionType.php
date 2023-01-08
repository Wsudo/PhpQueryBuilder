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
}
