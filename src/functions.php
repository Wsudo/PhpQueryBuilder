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
    use Wsudo\PhpQueryBuilder\Throwables\Exception;
    use function Amp\Future\awaitAll as ampAwaitAll;
    use function Amp\async as ampAsync;

    /**
     * await a future or list of futures to be execute
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

        throw new Exception("Future should pass to " . __FUNCTION__);
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
}







