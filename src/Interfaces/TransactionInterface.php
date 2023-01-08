<?php

namespace Wsudo\PhpQueryBuilder\Interfaces;

use Amp\Future;
use Wsudo\PhpQueryBuilder\Builders\Query;
use Wsudo\PhpQueryBuilder\ReadyQuery;
use Wsudo\PhpQueryBuilder\Types\DatabaseType;
use Wsudo\PhpQueryBuilder\Types\TransactionType;

interface TransactionInterface extends BuilderInterface
{
    public function query(Query $query): self;
    public function commit(TransactionType $transactionType):self;
    public function build(DatabaseType $databaseType): ReadyQuery;
    public function asyncBuild(DatabaseType $databaseType):Future;
}

