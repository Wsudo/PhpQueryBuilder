<?php

namespace Wsudo\PhpQueryBuilder\Builders;

use Amp\Future;
use Amp\Internal\FutureState;
use Wsudo\PhpQueryBuilder\Builders\Query as QueryBuilder;
use Wsudo\PhpQueryBuilder\Interfaces\TransactionInterface;
use Wsudo\PhpQueryBuilder\ReadyQuery;
use Wsudo\PhpQueryBuilder\Types\DatabaseType;
use Wsudo\PhpQueryBuilder\Types\TransactionType;

class Transaction implements TransactionInterface
{

    /**
     * list of transaction queries
     * @var array<QueryBuilder>
     */
    protected array $queries = [];
    
    /**
     * check transaction is commited or not
     * @var bool
     */
    protected bool $commited = false;

    /**
     * type of the transaction
     * 
     * NOTE: read Wsudo\PhpQueryBuilder\Types\TransactionType
     * @var \Wsudo\PhpQueryBuilder\Types\TransactionType
     */
    protected TransactionType $transactionType;

    /**
     * create new Transaction Interface
     * @param TransactionType|null $transactionType
     */
    public function __construct(TransactionType $transactionType = null)
    {
        if(!is_null($transactionType))
        {
            $this->transactionType = $transactionType;
        }
    }

    /**
     * set transaction queries
     * @param array $queries
     * @return Transaction
     */
    public function setQueries(array $queries):self
    {
        $this->queries = $queries;
        return $this;
    }

    /**
     * get transaction queries
     * @return array
     */
    public function getQueries():array
    {
        return $this->queries;
    }

    /**
     * set transaction is commited or not
     * @param bool $commited
     * @return Transaction
     */
    public function setCommited(bool $commited):self
    {
        $this->commited = $commited;
        return $this;
    }

    /**
     * get transaction commited or not
     * @return bool
     */
    public function getCommited():bool
    {
        return $this->commited;
    }

    /**
     * set transaction type
     * @param TransactionType $transactionType
     * @return Transaction
     */
    public function setTransactionType(TransactionType $transactionType):self
    {
        $this->transactionType = $transactionType;
        return $this;
    }

    /**
     * get transaction type
     * @return TransactionType
     */
    public function getTransactionType():TransactionType
    {
        return $this->transactionType;
    }

    /**
     * check has any Query or not
     * @return bool
     */
    public function hasQuery():bool
    {
        return count($this->queries) > 0;
    }

    /**
     * add Transaction Query
     * 
     * NOTE: those should one by one and those will execute top to down
     * @param QueryBuilder $query
     * @return Transaction
     */
    public function query(QueryBuilder $query): self 
    {
        $this->queries[] = $query;
        return $this;
    }

    /**
     * set transaction as commited
     * 
     * NOTE: after commiting transaction you are not allow to add new Queries to transaction Queries !
     * @param TransactionType $transactionType
     * @return Transaction
     */
    public function commit(TransactionType $transactionType) :self
    {
        $this->transactionType = $transactionType;
        $this->commited = true;
        return $this;
    }

    /**
     * build transaction and return it as ReadyQuery
     * 
     * NOTE: this will done as blocking (non-async)
     * @param DatabaseType $databaseType
     * @return ReadyQuery
     */
    public function build(DatabaseType $databaseType): ReadyQuery 
    {
        return (new ReadyQuery);
    }

    /**
     * build transaction and return it as ReadyQuery
     * 
     * NOTE: this will done as non-blocking (async)
     * @param DatabaseType $databaseType
     * @return ReadyQuery
     */
    public function asyncBuild(DatabaseType $databaseType):Future 
    {
        return (new Future(new FutureState));
    }
}

