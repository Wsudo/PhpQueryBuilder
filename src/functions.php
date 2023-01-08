<?php


namespace Wsudo\PhpQueryBuilder
{

    use Amp\Cancellation;
    use Amp\Future;

    use Amp\Internal\Cancellable;
    use Amp\TimeoutCancellation;
    use Wsudo\PhpQueryBuilder\Throwables\Exception;
    use function Amp\Future\awaitAll as ampAwaitAll;
    use function Amp\async as ampAsync;

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

    function async(\Closure $callable , ...$args):Future
    {
        return ampAsync($callable, ...$args);
    }

    function timeout(float $time , string $message = "operation timed out"):TimeoutCancellation
    {
        return new TimeoutCancellation( $time , $message);
    }
}







