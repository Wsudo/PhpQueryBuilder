<?php


namespace Wsudo\PhpQueryBuilder
{

    use Amp\Cancellation;
    use Amp\Future;

    use function Amp\Future\awaitAll;

    function await(array|Future $futures , Cancellation $cancellation = null)
    {
        if(is_array($futures))
        {
            return awaitAll($futures , $cancellation);
        }

        if($futures instanceof Future)
        {
            return $futures->await($cancellation);
        }
    }
}







