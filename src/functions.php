<?php

/**
 * name space to hold functions
 */
namespace Wsudo\PhpQueryBuilder
{

    use Amp\Cancellation;
    use Amp\Future;

    use Amp\Internal\Cancellable;
    use Amp\TimeoutCancellation;
    use Wsudo\PhpQueryBuilder\Builders\Query;
    use Wsudo\PhpQueryBuilder\Builders\Transaction;
    use Wsudo\PhpQueryBuilder\Query as PhpQueryBuilderQuery;
    use Wsudo\PhpQueryBuilder\Throwables\Exception;
    use Wsudo\PhpQueryBuilder\Types\TransactionType;

    use function Amp\Future\awaitAll as ampAwaitAll;
    use function Amp\async as ampAsync;

    /**
     * await for a future to be execute
     * @param array|Future $futures
     * @param Cancellation|null $cancellation
     * @throws Exception
     * @return mixed
     */
    function await(array|Future $futures , Cancellation $cancellation = null)
    {
        if(is_array($futures))
        {
            return ampAwaitAll($futures , $cancellation);
        }

        if($futures instanceof Future)
        {
            return $futures->await($cancellation);
        }

        throw new Exception("valid Future should pass to " . __FUNCTION__);
    }

    /**
     * make a new future from callable
     * @param \Closure $callable
     * @param array $args
     * @return Future
     */
    function async(\Closure $callable , ...$args):Future
    {
        return ampAsync($callable, ...$args);
    }

    /**
     * create new time out cancellation and return it out
     * @param float $time time in seconds
     * @param string $message message which be throw as TimeoutExceotion
     * @return TimeoutCancellation
     */
    function timeout(float $time , string $message = "operation timed out"):TimeoutCancellation
    {
        return new TimeoutCancellation( $time , $message);
    }

    /**
     * return new fullQueryBuilder/tagged QueryBuilder instance
     * @param string|int $tagName
     * @return Query
     */
    function query(string|int $tagName = null):Query
    {
        if($tagName == null)
        {
            return PhpQueryBuilderQuery::newFullQueryBuilderInterface();
        }

        return PhpQueryBuilderQuery::tag($tagName);
    }

    /**
     * create new transaction builder
     * @param TransactionType|null $transactionType type of the transaction isolate level
     * @return Transaction
     */
    function transaction(TransactionType $transactionType = null):Transaction
    {
        return PhpQueryBuilderQuery::newTransaction($transactionType);
    }
}







