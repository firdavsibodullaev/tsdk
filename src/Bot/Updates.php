<?php


namespace Firdavs\Tsdk\Bot;


class Updates
{
    /**
     * @var string $updates
     */
    private string $updates;

    public function __construct(string $updates)
    {
        $this->updates = $updates;
    }
}