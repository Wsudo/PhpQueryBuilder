<?php


namespace Wsudo\PhpQueryBuilder
{

    use Amp\Cancellation;
    use Amp\Future;

    use Amp\Internal\Cancellable;
    use Amp\TimeoutCancellation;
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
    }

    function async(\Closure $callable , ...$args)
    {
        return ampAsync($callable, ...$args);
    }

    function timeout(float $time , string $message = "operation timeouted"):TimeoutCancellation
    {
        return new TimeoutCancellation( $time , $message);
    }
}







