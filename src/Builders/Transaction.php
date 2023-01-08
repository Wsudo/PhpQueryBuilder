<?php

namespace Wsudo\PhpQueryBuilder\Builders;

use Amp\Future;
use Amp\Internal\FutureState;
use Wsudo\PhpQueryBuilder\Builders\Query as BuildersQuery;
use Wsudo\PhpQueryBuilder\Interfaces\TransactionInterface;
use Wsudo\PhpQueryBuilder\ReadyQuery;
use Wsudo\PhpQueryBuilder\Types\DatabaseType;
use Wsudo\PhpQueryBuilder\Types\TransactionType;

class Transaction implements TransactionInterface
{

    protected array $queries = [];
    protected bool $commited = false;
    protected TransactionType $transactionType;

    public function __construct(TransactionType $transactionType = TransactionType::REPEATABLE_READ)
    {
        $this->transactionType = $transactionType;
    }

    public function setQueries(array $queries):self
    {
        $this->queries = $queries;
        return $this;
    }

    public function getQueries():array
    {
        return $this->queries;
    }

    public function setCommited(bool $commited):self
    {
        $this->commited = $commited;
        return $this;
    }

    public function getCommited():bool
    {
        return $this->commited;
    }

    public function setTransactionType(TransactionType $transactionType):self
    {
        $this->transactionType = $transactionType;
        return $this;
    }

    public function getTransactionType():TransactionType
    {
        return $this->transactionType;
    }

    public function hasQuery():bool
    {
        return count($this->queries) > 0;
    }

    public function query(BuildersQuery $query): self 
    {
        $this->queries[] = $query;
        return $this;
    }
    public function commit(TransactionType $transactionType) :self
    {
        $this->transactionType = $transactionType;
        $this->commited = true;
        return $this;
    }

    public function build(DatabaseType $databaseType): ReadyQuery 
    {
        return (new ReadyQuery);
    }
    public function asyncBuild(DatabaseType $databaseType):Future 
    {
        return (new Future(new FutureState));
    }
}

