<?php

namespace Wsudo\PhpQueryBuilder\Interfaces;

use Wsudo\PhpQueryBuilder\Builders\Query;
use Wsudo\PhpQueryBuilder\Types\DatabaseType;
use Wsudo\PhpQueryBuilder\Types\TransactionType;

interface TransactionInterface extends BuilderInterface
{
    public function query(Query $query): self;
    public function commit(TransactionType $transactionType);
    public function build(DatabaseType $databaseType);
    public function asyncBuild(DatabaseType $databaseType);
}

