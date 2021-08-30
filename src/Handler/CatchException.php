<?php


namespace Firdavs\Tsdk\Handler;


use GuzzleHttp\Exception\GuzzleException;

class CatchException
{
    /**
     * @var GuzzleException
     */
    private GuzzleException $exception;

    /**
     * CatchException constructor.
     * @param GuzzleException $exception
     */
    public function __construct(GuzzleException $exception)
    {
        $this->exception = $exception;
    }

    public function response()
    {
        return $this->exception->getMessage();
    }

}